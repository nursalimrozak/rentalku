<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = Maintenance::with('car')->latest('date')->get();
        return view('admin.maintenances.index', compact('maintenances'));
    }

    public function create()
    {
        $cars = Car::orderBy('name')->get();
        return view('admin.maintenances.create', compact('cars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'date' => 'required|date',
            'description' => 'required|string',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|in:scheduled,ongoing,completed',
        ]);

        $data = $request->all();
        if ($data['status'] === 'completed') {
            $data['end_date'] = now();
        } else {
            $data['end_date'] = null;
        }

        Maintenance::create($data);

        return redirect()->route('admin.maintenances.index')->with('success', 'Maintenance scheduled successfully.');
    }

    public function edit(Maintenance $maintenance)
    {
        $cars = Car::orderBy('name')->get();
        return view('admin.maintenances.edit', compact('maintenance', 'cars'));
    }

    public function update(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'date' => 'required|date',
            'description' => 'required|string',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|in:scheduled,ongoing,completed',
        ]);

        $data = $request->all();
        if ($data['status'] === 'completed' && $maintenance->status !== 'completed') {
             $data['end_date'] = now();
        } elseif ($data['status'] !== 'completed') {
             $data['end_date'] = null;
        }

        $maintenance->update($data);

        return redirect()->route('admin.maintenances.index')->with('success', 'Maintenance updated successfully.');
    }

    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('admin.maintenances.index')->with('success', 'Maintenance record deleted successfully.');
    }
}
