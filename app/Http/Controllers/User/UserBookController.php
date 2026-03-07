<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;

class UserBookController extends Controller
{
    public function index()
{
    $books = Book::with('kategori')->get();

    // pinjaman aktif user (pending / approved / dipinjam)
    $activeBorrowing = Borrowing::where('user_id', auth()->id())
        ->whereIn('status', ['pending', 'approved', 'dipinjam'])
        ->first();

    return view('user.books', compact('books', 'activeBorrowing'));
}
}
