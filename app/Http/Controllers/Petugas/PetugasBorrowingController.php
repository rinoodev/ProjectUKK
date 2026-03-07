<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetugasBorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])->latest()->get();
        return view('petugas.borrowing.index', compact('borrowings'));
    }

    public function show(Borrowing $borrowing)
    {
        return view('petugas.borrowing.show', compact('borrowing'));
    }

    public function edit(Borrowing $borrowing)
    {
        return view('petugas.borrowing.edit', compact('borrowing'));
    }

    public function update(Request $request, Borrowing $borrowing)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected,returned',
        ]);

        DB::transaction(function () use ($request, $borrowing) {

            if ($request->status === 'returned' && !$borrowing->returned_at) {
                $book = Book::lockForUpdate()->findOrFail($borrowing->book_id);
                $book->increment('stok');

                $borrowing->update([
                    'status' => 'returned',
                    'returned_at' => now(),
                ]);
            } else {
                $borrowing->update([
                    'status' => $request->status,
                ]);
            }
        });

        return redirect()
            ->route('petugas.borrowings.index')
            ->with('success', 'Peminjaman berhasil diperbarui');
    }

    public function destroy(Borrowing $borrowing)
    {
        $borrowing->delete();
        return back()->with('success', 'Riwayat peminjaman dihapus');
    }

    public function approve(Borrowing $borrowing)
    {
        DB::transaction(function () use ($borrowing) {
            $book = Book::lockForUpdate()->findOrFail($borrowing->book_id);

            if ($book->stok < 1) {
                abort(400, 'Stok buku habis');
            }

            $book->decrement('stok');

            $borrowing->update([
                'status' => 'approved'
            ]);
        });

        return back()->with('success', 'Peminjaman disetujui');
    }

    public function reject(Borrowing $borrowing)
    {
        $borrowing->update([
            'status' => 'rejected'
        ]);

        return back()->with('error', 'Peminjaman ditolak');
    }
}
