<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index()
    {
        $vouchers = \App\Models\Voucher::latest()->get();
        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        $brands = \App\Models\Car::distinct()->pluck('brand');
        return view('admin.vouchers.create', compact('brands'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:vouchers,code|max:255',
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'quota' => 'required|integer|min:0',
            'brand' => 'nullable|string',
            'description' => 'nullable|string',
            'minimum_spend' => 'nullable|numeric|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['brand'] = $request->input('brand') === 'all' ? null : $request->input('brand');

        \App\Models\Voucher::create($validated);

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher created successfully.');
    }

    public function edit($uuid)
    {
        $voucher = \App\Models\Voucher::where('uuid', $uuid)->firstOrFail();
        $brands = \App\Models\Car::distinct()->pluck('brand');
        return view('admin.vouchers.edit', compact('voucher', 'brands'));
    }

    public function update(\Illuminate\Http\Request $request, $uuid)
    {
        $voucher = \App\Models\Voucher::where('uuid', $uuid)->firstOrFail();

        $validated = $request->validate([
            'code' => 'required|string|max:255|unique:vouchers,code,' . $voucher->id,
            'type' => 'required|in:fixed,percent',
            'value' => 'required|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'quota' => 'required|integer|min:0',
            'brand' => 'nullable|string',
            'description' => 'nullable|string',
            'minimum_spend' => 'nullable|numeric|min:0',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['brand'] = $request->input('brand') === 'all' ? null : $request->input('brand');

        $voucher->update($validated);

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher updated successfully.');
    }

    public function destroy($uuid)
    {
        $voucher = \App\Models\Voucher::where('uuid', $uuid)->firstOrFail();
        $voucher->delete();

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher deleted successfully.');
    }
}
