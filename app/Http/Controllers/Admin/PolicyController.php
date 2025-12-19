<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $policies = \App\Models\Policy::all();
        return view('admin.policies.index', compact('policies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.policies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'icon' => 'nullable|string',
            'link_text' => 'nullable|string',
        ]);

        \App\Models\Policy::create($request->all());

        return redirect()->route('admin.policies.index')->with('success', 'Policy created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Policy $policy)
    {
        return view('admin.policies.edit', compact('policy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Policy $policy)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'content' => 'required|string',
            'icon' => 'nullable|string',
            'link_text' => 'nullable|string',
        ]);

        $policy->update($request->all());

        return redirect()->route('admin.policies.index')->with('success', 'Policy updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(\App\Models\Policy $policy)
    {
        $policy->delete();
        return redirect()->route('admin.policies.index')->with('success', 'Policy deleted successfully.');
    }
}
