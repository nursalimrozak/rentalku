<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RentalCommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $communities = \App\Models\RentalCommunity::all();
        return view('admin.rental_communities.index', compact('communities'));
    }

    public function create()
    {
        return view('admin.rental_communities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('community_images', 'public');
        }

        \App\Models\RentalCommunity::create($data);

        return redirect()->route('admin.rental-communities.index')->with('success', 'Community Image added successfully.');
    }

    public function edit(\App\Models\RentalCommunity $rentalCommunity)
    {
        return view('admin.rental_communities.edit', compact('rentalCommunity'));
    }

    public function update(Request $request, \App\Models\RentalCommunity $rentalCommunity)
    {
        $request->validate([
            'image' => 'nullable|image',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            if ($rentalCommunity->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($rentalCommunity->image);
            }
            $data['image'] = $request->file('image')->store('community_images', 'public');
        }

        $rentalCommunity->update($data);

        return redirect()->route('admin.rental-communities.index')->with('success', 'Community Image updated successfully.');
    }

    public function destroy(\App\Models\RentalCommunity $rentalCommunity)
    {
        if ($rentalCommunity->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($rentalCommunity->image);
        }
        $rentalCommunity->delete();
        return redirect()->route('admin.rental-communities.index')->with('success', 'Community Image deleted successfully.');
    }
}
