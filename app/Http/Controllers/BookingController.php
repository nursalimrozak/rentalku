<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rental_type' => 'required|in:daily,weekly,monthly',
            'service_type' => 'required|in:self_pickup,delivery',
            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_date' => 'required|date|after_or_equal:start_date',
            'end_time' => 'required',
            'car_id' => 'required|exists:cars,id',
            'passengers' => 'required|integer|min:1',
            'payment_type' => 'required|in:full_payment,down_payment',
        ]);

        $car = Car::findOrFail($request->car_id);
        
        $startDateTimeString = $request->start_date . ' ' . $request->start_time;
        $endDateTimeString = $request->end_date . ' ' . $request->end_time;
        
        $startDate = \Carbon\Carbon::parse($startDateTimeString);
        $endDate = \Carbon\Carbon::parse($endDateTimeString);
        
        if ($endDate->lessThanOrEqualTo($startDate)) {
            return back()->withErrors(['end_date' => 'End date and time must be after start date and time.'])->withInput();
        }

        // Check Availability (including 30 min buffer)
        if (!$car->isAvailable($startDate, $endDate)) {
            return back()->withErrors(['error' => 'Mobil tidak tersedia pada tanggal/jam yang dipilih. Harap beri jeda 30 menit dari booking sebelumnya.'])->withInput();
        }
        
        $totalDays = ceil($startDate->diffInHours($endDate) / 24);

        // Basic price calculation
        // In real app, this should be a service or helper shared with Admin/BookingController
        // For now, replicating simple logic:
        $basePrice = 0;
        if ($request->rental_type == 'daily') {
            $basePrice = $car->rental_rate_per_day * $totalDays;
        } elseif ($request->rental_type == 'weekly') {
            // Logic for weekly/monthly if applicable, currently simple daily rate fallback
             $basePrice = $car->rental_rate_per_day * $totalDays;
        } elseif ($request->rental_type == 'monthly') {
             $basePrice = $car->rental_rate_per_day * $totalDays;
        }

        $driverFee = 0;
        if ($request->boolean('use_driver')) {
            $driverFee = $car->driver_fee_in_city * $totalDays; 
        }

        $totalPrice = $basePrice + $driverFee;
        $voucherDiscount = 0;
        $voucherCode = null;

        if ($request->filled('voucher_code')) {
            $voucher = \App\Models\Voucher::where('code', $request->voucher_code)->first();

            if (!$voucher) {
                return back()->withErrors(['voucher_code' => 'Invalid voucher code.'])->withInput();
            }

            if (!$voucher->is_active) {
                return back()->withErrors(['voucher_code' => 'Voucher is not active.'])->withInput();
            }

            $now = \Carbon\Carbon::now();
            if ($now->lt($voucher->start_date) || $now->gt($voucher->end_date)) {
                return back()->withErrors(['voucher_code' => 'Voucher is expired or not yet valid.'])->withInput();
            }

            if ($voucher->quota > 0 && $voucher->used_count >= $voucher->quota) {
                 return back()->withErrors(['voucher_code' => 'Voucher quota exceeded.'])->withInput();
            }
            
            if ($totalPrice < $voucher->minimum_spend) {
                return back()->withErrors(['voucher_code' => 'Minimum spend for this voucher is Rp ' . number_format($voucher->minimum_spend, 0, ',', '.')])->withInput();
            }

            // Check Brand applicability (if voucher has brand set)
            if ($voucher->brand && strtolower($voucher->brand) !== strtolower($car->brand)) {
                 return back()->withErrors(['voucher_code' => 'This voucher is only valid for ' . $voucher->brand . ' cars.'])->withInput();
            }

            // Calculate Discount
            if (trim(strtolower($voucher->type)) === 'percent') {
                $voucherDiscount = $totalPrice * ($voucher->value / 100);
            } else {
                $voucherDiscount = $voucher->value;
            }
            
            // Ensure discount doesn't exceed total price
            $voucherDiscount = min($voucherDiscount, $totalPrice);
            
            $voucherCode = $voucher->code;
            
            // Increment used count
            $voucher->increment('used_count');
        }

        $finalPrice = $totalPrice - $voucherDiscount;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'car_id' => $car->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_days' => $totalDays,
            'rental_type' => $request->rental_type,
            'service_type' => $request->service_type,
            'delivery_address' => $request->service_type == 'delivery' ? $request->delivery_address : null,
            'passengers' => $request->passengers,
            'use_driver' => $request->boolean('use_driver'),
            'driver_fee' => $driverFee,
            'total_price' => $finalPrice, // Store final discounted price
            'voucher_code' => $voucherCode,
            'voucher_discount' => $voucherDiscount,
            'status' => 'pending_payment',
            'payment_type' => $request->payment_type,
        ]);

        return redirect()->route('my-bookings.show', $booking->id)->with('success', 'Booking created successfully! Please proceed to payment.');
    }
    public function uploadPayment(Request $request, Booking $booking)
    {
        // Ensure user owns the booking
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'payment_proof' => 'required|image|max:2048',
            // payment_type can be passed from form
            'payment_type' => 'required|in:down_payment,full_payment,repayment,penalty_payment',
        ]);

        $path = $request->file('payment_proof')->store('payments', 'public');
        
        // Determine amount based on type
        $amount = 0;
        if ($request->payment_type == 'full_payment') {
            $amount = $booking->total_price;
        } elseif ($request->payment_type == 'down_payment') {
            $amount = $booking->total_price * 0.5;
            // Check if there's already a verified DP? No need, this is upload.
        } elseif ($request->payment_type == 'repayment') {
            // Amount is remaining balance
             $totalPaid = $booking->payments()->where('status', 'verified')->where('type', '!=', 'penalty_payment')->sum('amount');
             $amount = $booking->total_price - $totalPaid;
        } elseif ($request->payment_type == 'penalty_payment') {
             $amount = $booking->total_penalty; // Simple full penalty payment
        }

        $booking->payments()->create([
            'amount' => $amount,
            'type' => $request->payment_type,
            'proof_file_path' => 'storage/' . $path,
            'status' => 'pending', // Pending verification
            'note' => 'Uploaded by user',
        ]);

        return redirect()->back()->with('success', 'Payment proof uploaded successfully! Please wait for admin verification.');
    }
}
