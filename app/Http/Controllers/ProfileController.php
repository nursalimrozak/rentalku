<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\UserDocument;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            // KTP Address
            'ktp_address' => 'nullable|string',
            'ktp_village' => 'nullable|string',
            'ktp_district' => 'nullable|string',
            'ktp_city' => 'nullable|string',
            'ktp_province' => 'nullable|string',
            'ktp_zip' => 'nullable|string',
            // Domicile Address
            'dom_address' => 'nullable|string',
            'dom_village' => 'nullable|string',
            'dom_district' => 'nullable|string',
            'dom_city' => 'nullable|string',
            'dom_province' => 'nullable|string',
            'dom_zip' => 'nullable|string',
            // Photo
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->except(['profile_photo', '_token', '_method']);

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo_path) {
                Storage::delete('public/' . $user->profile_photo_path);
            }
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $data['profile_photo_path'] = $path;
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function uploadDocument(Request $request)
    {
        $request->validate([
            'type' => 'required|in:ktp,sim,kk,akte,ijazah,employee_card,student_card,passport',
            'document_file' => 'required|file|max:5120|mimes:jpg,jpeg,png,pdf', // 5MB max
        ]);

        $user = Auth::user();
        // Store in 'local' disk (storage/app/documents) for privacy
        // Using 'documents' folder instead of 'details' to differentiate
        $path = $request->file('document_file')->store('documents/' . $user->id, 'local');

        // Check if doc exists to update or create
        $user->documents()->updateOrCreate(
            ['type' => $request->type],
            [
                'file_path' => $path,
                'status' => 'pending', // Reset status to pending on new upload
                'rejection_reason' => null
            ]
        );

        return redirect()->back()->with('success', 'Document uploaded successfully.');
    }

    public function settings()
    {
        return view('dashboard.penyewa.settings');
    }
}
