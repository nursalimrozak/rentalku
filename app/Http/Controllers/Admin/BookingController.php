<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'car', 'payments'])->latest()->get();
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $cars = \App\Models\Car::where('status', 'available')->get();
        $users = \App\Models\User::orderBy('name')->get();
        $drivers = \App\Models\Driver::where('status', 'available')->get();
        return view('admin.bookings.create', compact('cars', 'users', 'drivers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rental_type' => 'required|in:daily,weekly,monthly',
            'service_type' => 'required|in:self_pickup,delivery',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'car_id' => 'required|exists:cars,id',
            'passengers' => 'required|integer|min:1',
            'payment_type' => 'required|in:full_payment,down_payment',
        ]);

        // 1. Handle User
        $userId = $request->user_id;
        if (!$userId) {
            $request->validate([
                'new_user_name' => 'required|string',
                'new_user_email' => 'required|email|unique:users,email',
                'new_user_phone' => 'required|string',
                'new_user_password' => 'required|string|min:6',
            ]);

            $user = \App\Models\User::create([
                'name' => $request->new_user_name,
                'email' => $request->new_user_email,
                'password' => \Illuminate\Support\Facades\Hash::make($request->new_user_password),
                'phone_number' => $request->new_user_phone,
                'role' => 'penyewa',
                'is_verified' => true, // Auto verify if admin created
            ]);
            $userId = $user->id;
        }

        // 2. Calculate Prices
        $car = \App\Models\Car::find($request->car_id);
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);
        
        // Check Availability
        if (!$car->isAvailable($startDate, $endDate)) {
            return back()->with('error', 'Mobil tidak tersedia pada jadwal tersebut (termasuk jeda 30 menit).')->withInput();
        }
        
        $totalDays = ceil($startDate->diffInHours($endDate) / 24);

        $baseTotalInfo = $this->calculateRentalPrice($car, $request->rental_type, $totalDays);
        $baseTotal = $baseTotalInfo['total'];
        
        $driverFee = 0;
        if ($request->use_driver) {
             // Example logic: if out of town use higher fee. For now checking destination_type isn't in form, assuming in_city default
             $driverFee = $car->driver_fee_in_city * $totalDays; 
        }

        $totalPrice = $baseTotal + $driverFee;

        // 3. Create Booking
        $booking = Booking::create([
            'user_id' => $userId,
            'car_id' => $car->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_days' => $totalDays,
            'rental_type' => $request->rental_type,
            'service_type' => $request->service_type,
            'delivery_address' => $request->service_type == 'delivery' ? $request->delivery_address : null,
            'passengers' => $request->passengers,
            'use_driver' => $request->boolean('use_driver'),
            'driver_id' => $request->driver_id,
            'driver_fee' => $driverFee,
            'total_price' => $totalPrice,
            'status' => 'pending_payment',
            'km_limit' => $request->km_limit,
            'excess_km_price' => $request->excess_km_price,
            // Temporary note about payment type preference? Not storing preference yet, will be handled in first payment upload
        ]);

        return redirect()->route('admin.bookings.show', $booking->id)->with('success', 'Reservation created! Please upload payment proof.');
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'car_id' => 'required|exists:cars,id',
        ]);

        $car = \App\Models\Car::find($request->car_id);
        $startDate = \Carbon\Carbon::parse($request->start_date);
        $endDate = \Carbon\Carbon::parse($request->end_date);

        if (!$car->isAvailable($startDate, $endDate)) {
            return response()->json(['available' => false, 'message' => 'Mobil tidak tersedia pada jadwal tersebut (termasuk jeda 30 menit).']);
        }

        return response()->json(['available' => true]);
    }

    private function calculateRentalPrice($car, $type, $days)
    {
        // Placeholder for complex calculation logic (seasonal, etc)
        // For now simple daily rate * days
        return ['total' => $car->rental_rate_per_day * $days];
    }

    public function uploadPayment(Request $request, Booking $booking)
    {
        $request->validate([
            'payment_proof' => 'required|image|max:2048',
            'payment_type' => 'required|in:down_payment,full_payment,repayment,penalty_payment',
        ]);

        $path = $request->file('payment_proof')->store('payments', 'public');
        
        // Determine amount based on type
        $amount = 0;
        if ($request->payment_type == 'full_payment') {
            $amount = $booking->total_price;
        } elseif ($request->payment_type == 'down_payment') {
            $amount = $booking->total_price * 0.5;
            $paid = $booking->payments()->where('status', 'verified')->where('type', '!=', 'penalty_payment')->sum('amount');
            $amount = $booking->total_price - $paid;
        } elseif ($request->payment_type == 'penalty_payment') {
             // Validate items
             $request->validate([
                 'penalty_items' => 'required|array|min:1',
                 'penalty_items.*.description' => 'required|string',
                 'penalty_items.*.amount' => 'required|numeric|min:0',
             ]);

             // Calculate total from items to be safe
             $amount = 0;
             $noteParts = [];
             foreach ($request->penalty_items as $item) {
                 $amount += $item['amount'];
                 $noteParts[] = $item['description'] . ' (IDR ' . number_format($item['amount'], 0, ',', '.') . ')';
             }
             $note = implode(', ', $noteParts);
             $details = json_encode($request->penalty_items);
        }

        $booking->payments()->create([
            'amount' => $amount,
            'type' => $request->payment_type,
            'proof_file_path' => 'storage/' . $path,
            'status' => 'verified', 
            'note' => $note ?? null,
            'details' => $details ?? null,
        ]);

        // Auto update status logic (existing)
        if ($request->payment_type == 'full_payment') {
             if($booking->status == 'pending_payment') {
                 $booking->update(['status' => 'confirmed']);
             }
        } elseif ($request->payment_type == 'down_payment') {
             if($booking->status == 'pending_payment') {
                 // As per user request, can be confirmed or dp_50. Using dp_50 for distinct tracking as per initial request.
                 // User update: "if approved by admin status can be changed to confirmed". 
                 // So we allow confirmed. But let's set it to dp_50 first, admin can manually change to confirmed if they want, 
                 // OR we set to dp_50 and upon repayment set to confirmed.
                 $booking->update(['status' => 'confirmed']); // Changed to confirmed as per latest request
             }
        } elseif ($request->payment_type == 'repayment') {
             // Check if fully paid
             $totalPaid = $booking->payments()->where('status', 'verified')->where('type', '!=', 'penalty_payment')->sum('amount') + $amount;
             if ($totalPaid >= $booking->total_price) {
                 $booking->update(['status' => 'confirmed']);
             }
        }

        return redirect()->back()->with('success', 'Payment proof uploaded successfully.');
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'car', 'payments', 'driver']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending_payment,dp_50,confirmed,ongoing,completed,cancelled,penalty_pending,penalty_paid',
        ]);

        $newStatus = $request->status;
        
        // Constraint: Cannot change to 'ongoing' or 'completed' if not fully paid
        if (in_array($newStatus, ['ongoing', 'completed'])) {
            $totalPaid = $booking->payments()->where('status', 'verified')->where('type', '!=', 'penalty_payment')->sum('amount');
            // Allow small margin of error or exact check
            if ($totalPaid < $booking->total_price) {
                return back()->with('error', 'Cannot change status to ' . $newStatus . '. Booking is not fully paid.');
            }
        }

        $booking->update([
            'status' => $newStatus,
        ]);

        // Auto-verify pending payments if status implies payment received
        if (in_array($newStatus, ['confirmed', 'dp_50', 'penalty_paid', 'completed', 'ongoing'])) {
             $booking->payments()->where('status', 'pending')->update(['status' => 'verified']);
        }

        return redirect()->route('admin.bookings.show', $booking->id)->with('success', 'Booking status updated successfully.');
    }
}
