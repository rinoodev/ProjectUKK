<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserBorrowingController extends Controller
{
    public function create(Book $book)
    {
        return view('user.borrow.create', compact('book'));
    }

    public function store(Request $request, Book $book)
    {
        $activeBorrowing = Borrowing::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($activeBorrowing) {
            return back()->with('error', 'Kembalikan buku terlebih dahulu.');
        }

        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'due_date' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        Borrowing::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'due_date' => $request->due_date,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('user.books')
            ->with('success', 'Permintaan peminjaman dikirim');
    }

    public function returnPage(Borrowing $borrowing)
    {
        abort_if($borrowing->user_id !== auth()->id(), 403);

        $borrowing->load('book');

        return view('user.borrow.return', compact('borrowing'));
    }

    public function return(Borrowing $borrowing)
    {
        abort_if($borrowing->user_id !== auth()->id(), 403);

        if ($borrowing->status !== 'approved') {
            abort(400, 'Buku belum dipinjam');
        }

        DB::transaction(function () use ($borrowing) {
            $book = Book::lockForUpdate()->findOrFail($borrowing->book_id);

            $book->increment('stok');

            $borrowing->update([
                'status' => 'returned',
                'returned_at' => now(),
            ]);
        });

        return redirect()
            ->route('user.books')
            ->with('success', 'Buku berhasil dikembalikan');
    }
}
