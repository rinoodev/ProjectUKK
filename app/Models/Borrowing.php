<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'status',
        'tanggal_pinjam',
        'returned_at', // ✅ SESUAI DB
    ];

    /**
     * ⬇️ WAJIB BIAR KEDETEK
     */
    protected $casts = [
        'tanggal_pinjam' => 'date',
        'returned_at'    => 'datetime',
    ];

    // RELATION
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
