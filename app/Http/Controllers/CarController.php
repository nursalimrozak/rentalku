<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = \App\Models\Car::latest()->paginate(9);
        return view('cars.index', compact('cars'));
    }

    public function show(\App\Models\Car $car)
    {
        return view('car_details', compact('car'));
    }
}
