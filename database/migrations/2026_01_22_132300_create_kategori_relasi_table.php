<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Membuat tabel pivot untuk relasi many-to-many antara books dan categories
     * Memungkinkan satu buku bisa punya banyak kategori
     * Dan satu kategori bisa punya banyak buku
     */
    public function up(): void
    {
        Schema::create('kategori_relasi', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Foreign keys
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('category_id');

            // Timestamps
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('book_id')
                  ->references('id')
                  ->on('books')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            // Unique constraint untuk mencegah duplikasi relasi
            $table->unique(['book_id', 'category_id']);

            // Index untuk performa query
            $table->index('book_id');
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_relasi');
    }
};
