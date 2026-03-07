<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('kode_buku')->unique();
            $table->text('deskripsi')->nullable();
            
            $table->string('judul');
            $table->string('penulis');
            $table->string('penerbit');
            $table->year('tahun');
            $table->integer('stok');

            // 🔗 RELASI KE TABLE categories
            $table->unsignedBigInteger('KategoriID');

            $table->string('image')->nullable();
            $table->timestamps();

            // FOREIGN KEY
            $table->foreign('KategoriID')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
