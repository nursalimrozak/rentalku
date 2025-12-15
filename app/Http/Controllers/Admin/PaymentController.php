<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'car', 'payments'])->latest()->get();

        // Calculate dynamic statuses for display
        $bookings->transform(function ($booking) {
            $totalPaid = $booking->payments->where('status', 'verified')->sum('amount');
            $totalPrice = $booking->total_price;

            if ($booking->status == 'cancelled') {
                $booking->payment_status_label = 'Dibatalkan';
                $booking->payment_status_badge = 'badge-danger-transparent';
            } elseif (in_array($booking->status, ['refund_pending', 'refunded'])) {
                $booking->payment_status_label = 'Refund';
                $booking->payment_status_badge = 'badge-warning-transparent';
            } elseif ($totalPaid >= $totalPrice) {
                $booking->payment_status_label = 'Lunas';
                $booking->payment_status_badge = 'badge-success-transparent';
            } elseif ($totalPaid > 0) {
                $booking->payment_status_label = 'DP 50%'; // Assuming mostly DP logic for now
                $booking->payment_status_badge = 'badge-info-transparent';
            } else {
                $booking->payment_status_label = 'Menunggu Pembayaran';
                $booking->payment_status_badge = 'badge-warning-transparent';
            }
            
            $booking->total_paid = $totalPaid;
            
            return $booking;
        });

        return view('admin.payments.index', compact('bookings'));
    }
}
