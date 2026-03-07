<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Rating;

class HomeController extends Controller
{

public function index()
{
    // daftar buku preview
    $books = Book::with(['ratings', 'kategori'])
        ->withAvg('ratings', 'rating')
        ->withCount('ratings')
        ->latest()
        ->take(6)
        ->get();

    // ====== STATS ======
    $totalBooks = Book::count();

    $totalUsers = User::where('role', 'user')->count();
    // kalau semua user dihitung → User::count();

    $avgRating = Rating::avg('rating') ?? 0;
    $avgRating = number_format($avgRating, 1);

    return view('welcome', compact(
        'books',
        'totalBooks',
        'totalUsers',
        'avgRating'
    ));
}
}