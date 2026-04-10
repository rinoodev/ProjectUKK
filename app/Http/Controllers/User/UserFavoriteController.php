<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Book;
use App\Models\Category;

class UserFavoriteController extends Controller
{

public function index()
    {
        $favorites = Favorite::where('user_id', auth()->id())
            ->with('book.categories')
            ->get();

        $categories = Category::select('id', 'nama')->get();

        return view('user.favorites', compact('favorites', 'categories'));
    }

    public function store(Book $book)
    {
        Favorite::firstOrCreate([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
        ]);

        return back();
    }

    // ⬇️ TAMBAH INI
    public function destroy(Book $book)
    {
        Favorite::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->delete();

        return back();
    }
}
