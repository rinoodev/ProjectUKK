<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Tampilkan daftar buku
     */
    public function index()
    {
        $books = Book::with('categories')->latest()->get();
        return view('admin.books.index', compact('books'));
    }

    /**
     * Form tambah buku
     */
    public function create()
    {
        $categories = Category::orderBy('nama')->get();
        return view('admin.books.create', compact('categories'));
    }

    /**
     * Simpan buku baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_buku'  => 'required|string|max:50|unique:books,kode_buku',
            'judul'      => 'required|string|max:255',
            'penulis'    => 'required|string|max:255',
            'penerbit'   => 'required|string|max:255',
            'tahun'      => 'required|digits:4',
            'stok'       => 'required|integer|min:0',
            'kategori_id' => 'required|array|min:1',
            'kategori_id.*' => 'exists:categories,id',
            'deskripsi'  => 'nullable|string',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
            'tahun'      => $request->tahun,
            'stok'       => $request->stok,
            'KategoriID' => $request->kategori_id[0],
            'deskripsi'  => $request->deskripsi,
            'image'      => $imagePath,
        ]);

        // Sync categories
        $book->categories()->sync($request->kategori_id);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Detail buku
     */
    public function show(Book $book)
    {
        $book->load('categories');
        return view('admin.books.show', compact('book'));
    }

    /**
     * Form edit buku
     */
    public function edit(Book $book)
    {
        $categories = Category::orderBy('nama')->get();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    /**
     * Update data buku
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'kode_buku'  => 'required|string|max:50|unique:books,kode_buku,' . $book->id,
            'judul'      => 'required|string|max:255',
            'penulis'    => 'required|string|max:255',
            'penerbit'   => 'required|string|max:255',
            'tahun'      => 'required|digits:4',
            'stok'       => 'required|integer|min:0',
            'kategori_id' => 'required|array|min:1',
            'kategori_id.*' => 'exists:categories,id',
            'deskripsi'  => 'nullable|string',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($book->image && Storage::disk('public')->exists($book->image)) {
                Storage::disk('public')->delete($book->image);
            }
            $book->image = $request->file('image')->store('books', 'public');
        }

        $book->update([
            'kode_buku'  => $request->kode_buku,
            'judul'      => $request->judul,
            'penulis'    => $request->penulis,
            'penerbit'   => $request->penerbit,
            'tahun'      => $request->tahun,
            'stok'       => $request->stok,
            'KategoriID' => $request->kategori_id[0],
            'deskripsi'  => $request->deskripsi,
            'image'      => $book->image,
        ]);

        // Sync categories
        $book->categories()->sync($request->kategori_id);

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil diperbarui');
    }

    /**
     * Hapus buku
     */
    public function destroy(Book $book)
    {
        if ($book->image && Storage::disk('public')->exists($book->image)) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();

        return redirect()
            ->route('admin.books.index')
            ->with('success', 'Buku berhasil dihapus');
    }
}
