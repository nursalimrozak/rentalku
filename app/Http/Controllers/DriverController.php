<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::where('status', '!=', 'busy')->paginate(9); // Show available or all? User implied listing data. Using simple pagination.
        // Actually user said "menampilkan data drivers", might want to see all. But availability is key. 
        // Let's show all for now but maybe filter by default? I'll show all but indicate status.
        $drivers = Driver::paginate(9);
        return view('drivers.index', compact('drivers'));
    }

    public function show(Driver $driver)
    {
        return view('drivers.show', compact('driver'));
    }
}
