<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
// Relasi ke rating
    // relasi rating
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // rata-rata rating
    public function averageRating()
    {
        return (float) ($this->ratings()->avg('rating') ?? 0);
    }

    public function ratingCount()
    {
        return $this->ratings()->count();
    }
    protected $fillable = [
    'kode_buku',
    'judul',
    'penulis',
    'penerbit',
    'tahun',
    'stok',
    'KategoriID',
    'deskripsi',
    'image',
];

public function kategori()
    {
        return $this->belongsTo(Category::class, 'KategoriID');
    }


public function category()
    {
        return $this->belongsTo(Category::class, 'KategoriID');
    }

    // Relasi many-to-many ke categories
    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'kategori_relasi',
            'book_id',
            'category_id'
        )->withTimestamps();
    }



}