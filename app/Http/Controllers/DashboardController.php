<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'penyewa') {
            return view('dashboard.penyewa.index', compact('user'));
        }

        if (in_array($user->role, ['admin', 'super_admin'])) {
            return view('dashboard.admin.index', compact('user'));
        }

        return abort(403);
    }
}
