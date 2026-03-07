<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Book;
use Illuminate\Http\Request;

class UserRatingController extends Controller
{
    public function create(Book $book)
    {
        $book->load(['ratings.user']);
        return view('user.borrow.create', compact('book'));
    }

    public function store(Request $request, Book $book)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string|max:1000'
        ]);

        // Simpan atau update rating user
        $rating = Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'book_id' => $book->id,
            ],
            [
                'rating' => $request->rating,
                'ulasan' => $request->ulasan
            ]
        );

        // Ambil SEMUA rating buku ini lalu hitung rata-rata
        $ratings = Rating::where('book_id', $book->id)->pluck('rating');

        $avg = $ratings->avg();   // otomatis rata-rata walau beda-beda
        $count = $ratings->count();

        return response()->json([
            'success' => true,
            'message' => 'Ulasan berhasil disimpan',
            'avg' => round($avg, 1), // contoh: 4.3
            'count' => $count,
            'ulasan' => $rating->ulasan
        ]);
    }
}