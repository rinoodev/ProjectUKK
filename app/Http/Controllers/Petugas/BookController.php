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
        $books = Book::with('categories')->latest()->get();
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
            'kode_buku'  => 'required|string|max:50|unique:books,kode_buku',
            'judul'      => 'required',
            'penulis'    => 'required',
            'penerbit'   => 'required',
            'kategori_id' => 'required|array|min:1',
            'kategori_id.*' => 'exists:categories,id',
            'tahun'      => 'required|numeric',
            'stok'       => 'required|numeric',
            'deskripsi'  => 'nullable|string',
            'image'      => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
        }

        $book = Book::create([
            'kode_buku'  => $request->kode_buku,
            'judul'      => $request->judul,
            'penulis'    => $request->penulis,
            'penerbit'   => $request->penerbit,
            'KategoriID' => $request->kategori_id[0], // Keep for backward compatibility
            'tahun'      => $request->tahun,
            'stok'       => $request->stok,
            'deskripsi'  => $request->deskripsi,
            'image'      => $imagePath,
        ]);

        // Sync categories
        $book->categories()->sync($request->kategori_id);

        return redirect()
            ->route('petugas.books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    public function show(Book $book)
    {
        $book->load('categories');
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
            'kode_buku'  => 'required|string|max:50|unique:books,kode_buku,' . $book->id,
            'judul'      => 'required',
            'penulis'    => 'required',
            'penerbit'   => 'required',
            'kategori_id' => 'required|array|min:1',
            'kategori_id.*' => 'exists:categories,id',
            'tahun'      => 'required|numeric',
            'stok'       => 'required|numeric',
            'deskripsi'  => 'nullable|string',
            'image'      => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($book->image) {
                Storage::disk('public')->delete($book->image);
            }
            $book->image = $request->file('image')->store('books', 'public');
        }

        $book->update([
            'kode_buku'  => $request->kode_buku,
            'judul'      => $request->judul,
            'penulis'    => $request->penulis,
            'penerbit'   => $request->penerbit,
            'KategoriID' => $request->kategori_id[0], // Keep for backward compatibility
            'tahun'      => $request->tahun,
            'stok'       => $request->stok,
            'deskripsi'  => $request->deskripsi,
        ]);

        // Sync categories
        $book->categories()->sync($request->kategori_id);

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
