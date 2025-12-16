<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = \App\Models\Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'required|image',
        ]);

        $data = $request->all();
        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('brand_logos', 'public');
        }

        \App\Models\Brand::create($data);

        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully.');
    }

    public function edit(\App\Models\Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, \App\Models\Brand $brand)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'nullable|image',
        ]);

        $data = $request->all();
        if ($request->hasFile('logo')) {
            if ($brand->logo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($brand->logo);
            }
            $data['logo'] = $request->file('logo')->store('brand_logos', 'public');
        }

        $brand->update($data);

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }

    public function destroy(\App\Models\Brand $brand)
    {
        if ($brand->logo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($brand->logo);
        }
        $brand->delete();
        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully.');
    }
}
