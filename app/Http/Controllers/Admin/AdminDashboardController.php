<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Borrowing;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUser' => User::where('role', 'user')->count(),
            'totalPetugas' => User::where('role', 'petugas')->count(),
            'totalBorrowing' => Borrowing::count(),
        ]);
    }
}
