<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Car::query();
        
        // Filter by brand if selected
        if ($request->filled('brand')) {
            $brandsInput = (array) $request->brand;
            $query->whereIn('brand', $brandsInput);
        }
        
        $cars = $query->latest()->paginate(9)->withQueryString();
        
        // Get unique brands for filter
        $brands = \App\Models\Car::select('brand')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand');
        
        // Get selected dates for availability check
        $pickupDate = $request->filled('pickup_date') && $request->filled('pickup_time') 
            ? \Carbon\Carbon::parse($request->pickup_date . ' ' . $request->pickup_time)
            : null;
            
        $returnDate = $request->filled('return_date') && $request->filled('return_time')
            ? \Carbon\Carbon::parse($request->return_date . ' ' . $request->return_time)
            : null;
        
        return view('cars.index', compact('cars', 'brands', 'pickupDate', 'returnDate'));
    }

    public function show(\App\Models\Car $car)
    {
        // Get selected dates from request for availability check
        // Using Carbon::parse to match index method logic exactly
        $pickupDate = request()->filled('pickup_date') && request()->filled('pickup_time')
            ? \Carbon\Carbon::parse(request()->pickup_date . ' ' . request()->pickup_time)
            : null;
            
        $returnDate = request()->filled('return_date') && request()->filled('return_time')
            ? \Carbon\Carbon::parse(request()->return_date . ' ' . request()->return_time)
            : null;

        if ($pickupDate && $returnDate) {
            // Override status with dynamic calculation
            $car->status = ucfirst($car->getAvailabilityStatus($pickupDate, $returnDate));
        }

        $pickupDateStr = $pickupDate ? $pickupDate->format('Y-m-d') : null;
        $returnDateStr = $returnDate ? $returnDate->format('Y-m-d') : null;

        $faqs = \App\Models\Faq::all();
        $policies = \App\Models\Policy::all();

        return view('car_details', compact('car', 'pickupDateStr', 'returnDateStr', 'faqs', 'policies'));
    }

    public function policyShow(\App\Models\Policy $policy)
    {
        return view('policy_details', compact('policy'));
    }

}
