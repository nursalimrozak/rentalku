<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::latest()->get();
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        $brands = Car::distinct()->whereNotNull('brand')->pluck('brand');
        $models = Car::distinct()->whereNotNull('model')->pluck('model');
        $car_types = Car::distinct()->whereNotNull('car_type')->pluck('car_type');
        $colors = Car::distinct()->whereNotNull('color')->pluck('color');
        $transmissions = Car::distinct()->whereNotNull('transmission')->pluck('transmission');
        $fuel_types = Car::distinct()->whereNotNull('fuel_type')->pluck('fuel_type');
        $seating_capacities = Car::distinct()->whereNotNull('seating_capacity')->orderBy('seating_capacity')->pluck('seating_capacity');
        $years = Car::distinct()->whereNotNull('year')->orderBy('year', 'desc')->pluck('year');

        return view('admin.cars.create', compact(
            'brands', 'models', 'car_types', 'colors', 
            'transmissions', 'fuel_types', 'seating_capacities', 'years'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'car_type' => 'required',
            'color' => 'required',
            'year' => 'required|integer',
            'license_plate' => 'required|unique:cars,license_plate',
            'transmission' => 'required',
            'fuel_type' => 'required',
            'seating_capacity' => 'required|integer',
            'rental_rate_per_day' => 'required|numeric',
            'rental_rate_per_week' => 'nullable|numeric',
            'rental_rate_per_month' => 'nullable|numeric',
            'driver_fee_in_city' => 'required|numeric',
            'driver_fee_out_town' => 'required|numeric',
            'photo' => 'required|image|max:2048',
            'photos.*' => 'image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/cars'), $filename);
            $data['photo'] = 'uploads/cars/' . $filename;
        }

        $car = Car::create($data);

        // Handle Gallery Photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $key => $photo) {
                if ($key < 5) { // Limit to 5 photos
                    $filename = time() . '_' . $key . '.' . $photo->getClientOriginalExtension();
                    $photo->move(public_path('uploads/cars/gallery'), $filename);
                    $car->images()->create([
                        'image_path' => 'uploads/cars/gallery/' . $filename
                    ]);
                }
            }
        }

        return redirect()->route('admin.cars.index')->with('success', 'Car added successfully');
    }

    public function show(Car $car)
    {
        $car->load('images');
        return view('admin.cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        $brands = Car::distinct()->whereNotNull('brand')->pluck('brand');
        $models = Car::distinct()->whereNotNull('model')->pluck('model');
        $car_types = Car::distinct()->whereNotNull('car_type')->pluck('car_type');
        $colors = Car::distinct()->whereNotNull('color')->pluck('color');
        $transmissions = Car::distinct()->whereNotNull('transmission')->pluck('transmission');
        $fuel_types = Car::distinct()->whereNotNull('fuel_type')->pluck('fuel_type');
        $seating_capacities = Car::distinct()->whereNotNull('seating_capacity')->orderBy('seating_capacity')->pluck('seating_capacity');
        $years = Car::distinct()->whereNotNull('year')->orderBy('year', 'desc')->pluck('year');

        return view('admin.cars.edit', compact(
            'car',
            'brands', 'models', 'car_types', 'colors', 
            'transmissions', 'fuel_types', 'seating_capacities', 'years'
        ));
    }

    public function update(Request $request, Car $car)
    {
        $request->validate([
            'name' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'car_type' => 'required',
            'color' => 'required',
            'year' => 'required|integer',
            'license_plate' => 'required|unique:cars,license_plate,' . $car->id,
            'transmission' => 'required',
            'fuel_type' => 'required',
            'seating_capacity' => 'required|integer',
            'rental_rate_per_day' => 'required|numeric',
            'rental_rate_per_week' => 'nullable|numeric',
            'rental_rate_per_month' => 'nullable|numeric',
            'driver_fee_in_city' => 'required|numeric',
            'driver_fee_out_town' => 'required|numeric',
            'photo' => 'nullable|image|max:2048',
            'photos.*' => 'image|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            // Delete old photo
            if ($car->photo && file_exists(public_path($car->photo))) {
                unlink(public_path($car->photo));
            }
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/cars'), $filename);
            $data['photo'] = 'uploads/cars/' . $filename;
        }

        $car->update($data);

        // Handle Gallery Photos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $key => $photo) {
                // Check if adding more wouldn't exceed limit (optional check, but logic here just adds)
                if ($car->images()->count() < 5) { 
                    $filename = time() . '_' . $key . '.' . $photo->getClientOriginalExtension();
                    $photo->move(public_path('uploads/cars/gallery'), $filename);
                    $car->images()->create([
                        'image_path' => 'uploads/cars/gallery/' . $filename
                    ]);
                }
            }
        }

        return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully');
    }
}
