<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'penyewa') {
            return view('dashboard.penyewa.index', compact('user'));
        }

        if (in_array($user->role, ['admin', 'super_admin'])) {
            $stats = [
                'total_cars' => \App\Models\Car::count(),
                'cars_rented' => \App\Models\Booking::where('status', 'ongoing')->count(),
                'cars_available' => \App\Models\Car::where('status', 'available')->count(),
                'total_bookings' => \App\Models\Booking::count(),
                'total_earnings' => \App\Models\Booking::where('status', 'completed')->sum('total_price'),
                'recent_bookings' => \App\Models\Booking::with(['user', 'car'])->where('status', '!=', 'cancelled')->latest()->take(5)->get(),
                'recent_customers' => \App\Models\User::where('role', 'penyewa')->withCount('bookings')->latest()->take(5)->get(),
                'recent_drivers' => \App\Models\Driver::latest()->take(5)->get(),
                'recent_payments' => \App\Models\Payment::with(['booking.user'])->latest()->take(5)->get(),
                'new_car' => \App\Models\Car::latest()->first(),
                'total_drivers' => \App\Models\Driver::count(),
                'drivers_available' => \App\Models\Driver::where('status', 'available')->count(),
            ];
            return view('dashboard.admin.index', compact('user', 'stats'));
        }

        return abort(403);
    }
}
