<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['nama', 'slug'];

    public function books()
    {
        return $this->hasMany(Book::class, 'KategoriID');
    }

    // Relasi many-to-many ke books (dua jalur)
    public function booksRelated()
    {
        return $this->belongsToMany(
            Book::class,
            'kategori_relasi',
            'category_id',
            'book_id'
        )->withTimestamps();
    }
}
