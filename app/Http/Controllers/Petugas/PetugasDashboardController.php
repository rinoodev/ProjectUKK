<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;

class PetugasDashboardController extends Controller
{
    public function index()
    {
        return view('petugas.dashboard', [
            'totalBuku' => Book::count(),
            'pendingBorrowing' => Borrowing::where('status', 'pending')->count(),
            'approvedBorrowing' => Borrowing::where('status', 'approved')->count(),
        ]);
    }
}
