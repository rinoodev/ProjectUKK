<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;


class AdminRatingController extends Controller
{
    // ==============================
    // LIST SEMUA ULASAN
    // ==============================
    public function index()
    {
        $ratings = Rating::with(['user', 'book'])
            ->latest()
            ->paginate(10);

        return view('admin.ratings.index', compact('ratings'));
    }

    // ==============================
    // DETAIL ULASAN
    // ==============================
    public function show(Rating $rating)
    {
        $rating->load(['user', 'book']);
        return view('admin.ratings.show', compact('rating'));
    }

    // ==============================
    // FORM EDIT ULASAN
    // ==============================
    public function edit(Rating $rating)
    {
        $rating->load(['user', 'book']);
        return view('admin.ratings.edit', compact('rating'));
    }

    // ==============================
    // UPDATE ULASAN
    // ==============================
    public function update(Request $request, Rating $rating)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string|max:1000'
        ]);

        $rating->update([
            'rating' => $request->rating,
            'ulasan' => $request->ulasan
        ]);

        return redirect()
            ->route('admin.ratings.index')
            ->with('success', 'Ulasan berhasil diperbarui');
    }

    // ==============================
    // HAPUS ULASAN (OPSIONAL)
    // ==============================
    public function destroy(Rating $rating)
    {
        $rating->delete();

        return redirect()
            ->route('admin.ratings.index')
            ->with('success', 'Ulasan berhasil dihapus');
    }
}