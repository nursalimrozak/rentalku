<?php

namespace App\Http\Controllers;

use App\Models\UserDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DocumentController extends Controller
{
    /**
     * Serve the requested document securely.
     */
    public function show(UserDocument $document)
    {
        // 1. Authorization: Only Owner or Admin can view
        $user = Auth::user();
        
        if (!$user) {
            abort(403, 'Unauthorized action.');
        }

        $isOwner = $user->id === $document->user_id;
        $isAdmin = in_array($user->role, ['admin', 'super_admin']);

        if (!$isOwner && !$isAdmin) {
            abort(403, 'You do not have permission to view this document.');
        }

        // 2. Determine File Path and Disk
        // We first check the 'local' (private) disk, then fallback to 'public' for legacy files
        $path = $document->file_path;
        
        if (Storage::disk('local')->exists($path)) {
            return Storage::disk('local')->response($path);
        }
        
        if (Storage::disk('public')->exists($path)) {
             return Storage::disk('public')->response($path);
        }

        abort(404, 'File not found.');
    }
}
