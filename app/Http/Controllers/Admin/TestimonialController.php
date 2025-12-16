<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = \App\Models\Testimonial::all();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required',
            'photo' => 'nullable|image',
        ]);

        $data = $request->all();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('testimonials_photos', 'public');
        }

        \App\Models\Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial created successfully.');
    }

    public function edit(\App\Models\Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, \App\Models\Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required',
            'photo' => 'nullable|image',
        ]);

        $data = $request->all();
        if ($request->hasFile('photo')) {
            if ($testimonial->photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($testimonial->photo);
            }
            $data['photo'] = $request->file('photo')->store('testimonials_photos', 'public');
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(\App\Models\Testimonial $testimonial)
    {
        if ($testimonial->photo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($testimonial->photo);
        }
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')->with('success', 'Testimonial deleted successfully.');
    }
}
