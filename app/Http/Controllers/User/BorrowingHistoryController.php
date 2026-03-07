<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class BorrowingHistoryController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with('book')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('user.borrowing.index', compact('borrowings'));
    }

    public function show(Borrowing $borrowing)
    {
        abort_if($borrowing->user_id !== auth()->id(), 403);

        $borrowing->load('book');

        return view('user.borrowing.show', compact('borrowing'));
    }
}