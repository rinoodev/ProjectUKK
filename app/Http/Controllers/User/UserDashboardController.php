<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Favorite;

class UserDashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();

        $borrowedBooks = Borrowing::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->count();

        $favorites = Favorite::where('user_id', auth()->id())->count();

        return view('user.dashboard', compact(
            'totalBooks',
            'borrowedBooks',
            'favorites'
        ));
    }
}
