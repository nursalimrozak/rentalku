<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::latest()->paginate(10);
        return view('admin.drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('admin.drivers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|unique:drivers,phone_number',
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'bio' => 'nullable|string',
            'in_city_rate' => 'required|numeric',
            'out_of_town_rate' => 'required|numeric',
            'experience_years' => 'required|integer',
            'photo' => 'nullable|image|max:2048',
            'sim' => 'nullable|image|max:2048',
            'ktp' => 'nullable|image|max:2048',
            'kk' => 'nullable|image|max:2048',
            'status' => 'required|in:available,busy',
        ]);

        $data = $request->except(['photo', 'sim', 'ktp', 'kk']);

        // Handle Photo
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_photo.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/drivers/photos'), $filename);
            $data['photo'] = 'uploads/drivers/photos/' . $filename;
        }

        // Handle SIM
        if ($request->hasFile('sim')) {
            $file = $request->file('sim');
            $filename = time() . '_sim.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/drivers/documents/sim'), $filename);
            $data['sim'] = 'uploads/drivers/documents/sim/' . $filename;
        }

        // Handle KTP
        if ($request->hasFile('ktp')) {
            $file = $request->file('ktp');
            $filename = time() . '_ktp.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/drivers/documents/ktp'), $filename);
            $data['ktp'] = 'uploads/drivers/documents/ktp/' . $filename;
        }

        // Handle KK
        if ($request->hasFile('kk')) {
            $file = $request->file('kk');
            $filename = time() . '_kk.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/drivers/documents/kk'), $filename);
            $data['kk'] = 'uploads/drivers/documents/kk/' . $filename;
        }

        Driver::create($data);

        return redirect()->route('admin.drivers.index')->with('success', 'Driver created successfully');
    }

    public function show(Driver $driver)
    {
        return view('admin.drivers.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        return view('admin.drivers.edit', compact('driver'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'name' => 'required|string',
            'phone_number' => 'required|unique:drivers,phone_number,' . $driver->id,
            'gender' => 'required|in:male,female',
            'date_of_birth' => 'required|date',
            'bio' => 'nullable|string',
            'in_city_rate' => 'required|numeric',
            'out_of_town_rate' => 'required|numeric',
            'experience_years' => 'required|integer',
            'photo' => 'nullable|image|max:2048',
            'sim' => 'nullable|image|max:2048',
            'ktp' => 'nullable|image|max:2048',
            'kk' => 'nullable|image|max:2048',
            'status' => 'required|in:available,busy',
        ]);

        $data = $request->except(['photo', 'sim', 'ktp', 'kk']);

        // Handle Photo
        if ($request->hasFile('photo')) {
            if ($driver->photo && file_exists(public_path($driver->photo))) {
                unlink(public_path($driver->photo));
            }
            $file = $request->file('photo');
            $filename = time() . '_photo.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/drivers/photos'), $filename);
            $data['photo'] = 'uploads/drivers/photos/' . $filename;
        }

        // Handle SIM
        if ($request->hasFile('sim')) {
            if ($driver->sim && file_exists(public_path($driver->sim))) {
                unlink(public_path($driver->sim));
            }
            $file = $request->file('sim');
            $filename = time() . '_sim.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/drivers/documents/sim'), $filename);
            $data['sim'] = 'uploads/drivers/documents/sim/' . $filename;
        }

        // Handle KTP
        if ($request->hasFile('ktp')) {
            if ($driver->ktp && file_exists(public_path($driver->ktp))) {
                unlink(public_path($driver->ktp));
            }
            $file = $request->file('ktp');
            $filename = time() . '_ktp.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/drivers/documents/ktp'), $filename);
            $data['ktp'] = 'uploads/drivers/documents/ktp/' . $filename;
        }

        // Handle KK
        if ($request->hasFile('kk')) {
            if ($driver->kk && file_exists(public_path($driver->kk))) {
                unlink(public_path($driver->kk));
            }
            $file = $request->file('kk');
            $filename = time() . '_kk.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/drivers/documents/kk'), $filename);
            $data['kk'] = 'uploads/drivers/documents/kk/' . $filename;
        }

        $driver->update($data);

        return redirect()->route('admin.drivers.index')->with('success', 'Driver updated successfully');
    }

    public function destroy(Driver $driver)
    {
        if ($driver->photo && file_exists(public_path($driver->photo))) unlink(public_path($driver->photo));
        if ($driver->sim && file_exists(public_path($driver->sim))) unlink(public_path($driver->sim));
        if ($driver->ktp && file_exists(public_path($driver->ktp))) unlink(public_path($driver->ktp));
        if ($driver->kk && file_exists(public_path($driver->kk))) unlink(public_path($driver->kk));

        $driver->delete();

        return redirect()->route('admin.drivers.index')->with('success', 'Driver deleted successfully');
    }
}
