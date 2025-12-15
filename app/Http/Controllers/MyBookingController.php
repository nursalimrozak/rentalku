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

    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        
        // We can reuse a view or create a specific one. 
        // For now, let's assume we might want a specific user view vs admin view.
        // Or we can reuse existing admin view components if they are generic enough, but usually better to have separate.
        return view('dashboard.penyewa.bookings.show', compact('booking'));
    }
}
