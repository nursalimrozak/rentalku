<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'penyewa')->latest()->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $customer)
    {
        // Ensure we are viewing a customer
        if ($customer->role !== 'penyewa') {
            return redirect()->route('admin.customers.index')->with('error', 'User is not a customer.');
        }

        $customer->load(['bookings' => function($query) {
            $query->latest();
        }, 'bookings.car', 'documents']);

        // Calculate stats
        $totalRentals = $customer->bookings->count();
        $totalSpent = $customer->bookings->where('status', 'completed')->sum('total_price');

        return view('admin.customers.show', compact('customer', 'totalRentals', 'totalSpent'));
    }
    public function verify(User $customer)
    {
        $customer->update(['is_verified' => true]);
        return redirect()->back()->with('success', 'Customer account verified successfully.');
    }

    public function updateDocumentStatus(Request $request, $documentId)
    {
        $document = \App\Models\UserDocument::findOrFail($documentId);
        
        $request->validate([
            'status' => 'required|in:verified,rejected',
            'reason' => 'nullable|string'
        ]);

        $document->update([
            'status' => $request->status,
            'rejection_reason' => $request->status == 'rejected' ? $request->reason : null
        ]);

        return redirect()->back()->with('success', 'Document status updated.');
    }
}
