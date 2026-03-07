<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->latest()->get();
        return view('petugas.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('petugas.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required',
            'penulis'    => 'required',
            'penerbit'   => 'required',
            'KategoriID' => 'required|exists:categories,id',
            'tahun'      => 'required|numeric',
            'stok'       => 'required|numeric',
            'image'      => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
        }

        Book::create([
            'judul'      => $request->judul,
            'penulis'    => $request->penulis,
            'penerbit'   => $request->penerbit,
            'KategoriID' => $request->KategoriID, // ✅ FIX
            'tahun'      => $request->tahun,
            'stok'       => $request->stok,
            'image'      => $imagePath,
        ]);

        return redirect()
            ->route('petugas.books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    public function show(Book $book)
    {
        return view('petugas.books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('petugas.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'judul'      => 'required',
            'penulis'    => 'required',
            'penerbit'   => 'required',
            'KategoriID' => 'required|exists:categories,id',
            'tahun'      => 'required|numeric',
            'stok'       => 'required|numeric',
            'image'      => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            $book->image = $request->file('image')->store('books', 'public');
        }

        $book->update([
            'judul'      => $request->judul,
            'penulis'    => $request->penulis,
            'penerbit'   => $request->penerbit,
            'KategoriID' => $request->KategoriID,
            'tahun'      => $request->tahun,
            'stok'       => $request->stok,
        ]);

        return redirect()
            ->route('petugas.books.index')
            ->with('success', 'Buku berhasil diperbarui');
    }

    public function destroy(Book $book)
    {
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()
            ->route('petugas.books.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}
