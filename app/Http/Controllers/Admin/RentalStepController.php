<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentalStep;

class RentalStepController extends Controller
{
    public function index()
    {
        $rentalSteps = RentalStep::all();
        return view('admin.rental-steps.index', compact('rentalSteps'));
    }

    public function create()
    {
        return view('admin.rental-steps.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'icon' => 'required',
        ]);

        RentalStep::create($request->all());

        return redirect()->route('admin.rental-steps.index')->with('success', 'Rental Step created successfully.');
    }

    public function edit(RentalStep $rentalStep)
    {
        return view('admin.rental-steps.edit', compact('rentalStep'));
    }

    public function update(Request $request, RentalStep $rentalStep)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'icon' => 'required',
        ]);

        $rentalStep->update($request->all());

        return redirect()->route('admin.rental-steps.index')->with('success', 'Rental Step updated successfully.');
    }

    public function destroy(RentalStep $rentalStep)
    {
        $rentalStep->delete();
        return redirect()->route('admin.rental-steps.index')->with('success', 'Rental Step deleted successfully.');
    }
}
