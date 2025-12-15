<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeasonalPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seasonalPrices = \App\Models\SeasonalPrice::latest()->get();
        return view('admin.seasonal_prices.index', compact('seasonalPrices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.seasonal_prices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price_increase' => 'required|numeric|min:0',
        ]);

        \App\Models\SeasonalPrice::create($validated);

        return redirect()->route('admin.seasonal-prices.index')
            ->with('success', 'Seasonal price created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($uuid)
    {
        $seasonalPrice = \App\Models\SeasonalPrice::where('uuid', $uuid)->firstOrFail();
        return view('admin.seasonal_prices.edit', compact('seasonalPrice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\Illuminate\Http\Request $request, $uuid)
    {
        $seasonalPrice = \App\Models\SeasonalPrice::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'price_increase' => 'required|numeric|min:0',
        ]);

        $seasonalPrice->update($validated);

        return redirect()->route('admin.seasonal-prices.index')
            ->with('success', 'Seasonal price updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($uuid)
    {
        $seasonalPrice = \App\Models\SeasonalPrice::where('uuid', $uuid)->firstOrFail();
        $seasonalPrice->delete();

        return redirect()->route('admin.seasonal-prices.index')
            ->with('success', 'Seasonal price deleted successfully.');
    }
}
