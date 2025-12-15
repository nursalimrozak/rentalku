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
        $booking = Booking::with(['car', 'payments'])->findOrFail($id);

        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $bankAccounts = \App\Models\BankAccount::where('is_active', true)->get();
        
        return view('dashboard.penyewa.bookings.show', compact('booking', 'bankAccounts'));
    }
}
