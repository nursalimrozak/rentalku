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
            'end_date' => 'nullable|date|after_or_equal:date',
            'description' => 'required|string',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|in:scheduled,ongoing,completed',
            'proof_file_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = $request->except('proof_file_path');
        
        // Handle file upload
        if ($request->hasFile('proof_file_path')) {
            $path = $request->file('proof_file_path')->store('maintenance_proofs', 'public');
            $data['proof_file_path'] = 'storage/' . $path;
        }

        // Normalize end_date to end of day (23:59:59) if provided
        if ($request->filled('end_date')) {
            $data['end_date'] = \Carbon\Carbon::parse($request->end_date)->endOfDay();
        }
        
        // Auto-set end_date if status is completed and end_date not provided
        if ($data['status'] === 'completed' && !$request->filled('end_date')) {
            $data['end_date'] = now();
        }

        $maintenance = Maintenance::create($data);

        // Update car status based on maintenance status
        $car = Car::find($request->car_id);
        if (in_array($data['status'], ['scheduled', 'ongoing'])) {
            $car->update(['status' => 'maintenance']);
        } elseif ($data['status'] === 'completed') {
            $car->update(['status' => 'available']);
        }

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
            'end_date' => 'nullable|date|after_or_equal:date',
            'description' => 'required|string',
            'cost' => 'required|numeric|min:0',
            'status' => 'required|in:scheduled,ongoing,completed',
            'proof_file_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = $request->except('proof_file_path');
        
        // Handle file upload
        if ($request->hasFile('proof_file_path')) {
            // Delete old file if exists
            if ($maintenance->proof_file_path && file_exists(public_path($maintenance->proof_file_path))) {
                unlink(public_path($maintenance->proof_file_path));
            }
            
            $path = $request->file('proof_file_path')->store('maintenance_proofs', 'public');
            $data['proof_file_path'] = 'storage/' . $path;
        }

        // Normalize end_date to end of day (23:59:59) if provided
        if ($request->filled('end_date')) {
            $data['end_date'] = \Carbon\Carbon::parse($request->end_date)->endOfDay();
        }
        
        // Auto-set end_date if status changed to completed and end_date not provided
        if ($data['status'] === 'completed' && $maintenance->status !== 'completed' && !$request->filled('end_date')) {
            $data['end_date'] = now();
        } elseif ($data['status'] !== 'completed' && !$request->filled('end_date')) {
            $data['end_date'] = null;
        }

        $maintenance->update($data);

        // Update car status based on maintenance status
        $car = Car::find($request->car_id);
        if (in_array($data['status'], ['scheduled', 'ongoing'])) {
            $car->update(['status' => 'maintenance']);
        } elseif ($data['status'] === 'completed') {
            $car->update(['status' => 'available']);
        }

        return redirect()->route('admin.maintenances.index')->with('success', 'Maintenance updated successfully.');
    }


    public function destroy(Maintenance $maintenance)
    {
        // Store car_id and status before deletion
        $carId = $maintenance->car_id;
        $wasScheduledOrOngoing = in_array($maintenance->status, ['scheduled', 'ongoing']);
        
        // Delete proof file if exists
        if ($maintenance->proof_file_path && file_exists(public_path($maintenance->proof_file_path))) {
            unlink(public_path($maintenance->proof_file_path));
        }
        
        $maintenance->delete();
        
        // Restore car status to available if maintenance was scheduled or ongoing
        if ($wasScheduledOrOngoing) {
            $car = Car::find($carId);
            if ($car) {
                $car->update(['status' => 'available']);
            }
        }
        
        return redirect()->route('admin.maintenances.index')->with('success', 'Maintenance record deleted successfully.');
    }
}
