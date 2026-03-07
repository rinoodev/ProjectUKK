<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;

class AdminBorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])
            ->latest()
            ->get()
            ->map(function ($item) {
                $item->is_returned = $item->status === 'returned';
                return $item;
            });

        return view('admin.borrowing.index', compact('borrowings'));
    }

    public function show(Borrowing $borrowing)
    {
        $borrowing->is_returned = $borrowing->status === 'returned';
        return view('admin.borrowing.show', compact('borrowing'));
    }
}