<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SectionSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = \App\Models\SectionSetting::all();
        return view('admin.section_settings.index', compact('settings'));
    }

    public function create()
    {
        return view('admin.section_settings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|unique:section_settings,key',
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('section_images', 'public');
        }

        \App\Models\SectionSetting::create($data);

        return redirect()->route('admin.section-settings.index')->with('success', 'Section Setting created successfully.');
    }

    public function edit(\App\Models\SectionSetting $sectionSetting)
    {
        return view('admin.section_settings.edit', compact('sectionSetting'));
    }

    public function update(Request $request, \App\Models\SectionSetting $sectionSetting)
    {
        $request->validate([
            'key' => 'required|unique:section_settings,key,' . $sectionSetting->id,
            'title' => 'required',
            'description' => 'nullable',
            'image' => 'nullable|image',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            if ($sectionSetting->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($sectionSetting->image);
            }
            $data['image'] = $request->file('image')->store('section_images', 'public');
        }

        $sectionSetting->update($data);

        return redirect()->route('admin.section-settings.index')->with('success', 'Section Setting updated successfully.');
    }

    public function destroy(\App\Models\SectionSetting $sectionSetting)
    {
        if ($sectionSetting->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($sectionSetting->image);
        }
        $sectionSetting->delete();
        return redirect()->route('admin.section-settings.index')->with('success', 'Section Setting deleted successfully.');
    }
}
