<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class MyBookingController extends Controller
{
    public function index()
    {
        $bookings = Auth::user()->bookings()
            ->with(['car'])
            ->latest()
            ->paginate(10);
            
        return view('dashboard.penyewa.bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::with('car', 'payments')->findOrFail($id);

        // Check for auto-cancellation (Lazy Check)
        // If the user visits the page after 15 mins and it's still pending with no proof, cancel it immediately.
        if ($booking->status == 'pending_payment' && 
            $booking->created_at->lt(\Carbon\Carbon::now()->subMinutes(15)) && 
            !$booking->payments()->whereIn('status', ['pending', 'verified'])->exists()) {
            
            $booking->update(['status' => 'cancelled']);
            $booking->refresh();
        }
        $bankAccounts = \App\Models\BankAccount::where('is_active', true)->get();
        
        return view('dashboard.penyewa.bookings.show', compact('booking', 'bankAccounts'));
    }
}
