<div align="center">

# 📚 Perpustakaan Digital
### Aplikasi Web Manajemen Perpustakaan Modern
**Dibangun dengan Laravel 12 + Breeze + MySQL**

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

</div>

---

## 🗂️ Daftar Isi

- [Tentang Proyek](#-tentang-proyek)
- [Fitur Utama](#-fitur-utama)
- [Prasyarat](#-prasyarat)
- [Cara Clone dari GitHub](#-cara-clone-dari-github)
- [Langkah Pengerjaan](#-langkah-pengerjaan)
  - [1. Setup Proyek Laravel](#langkah-1--setup-proyek-laravel-12)
  - [2. Instalasi Laravel Breeze](#langkah-2--instalasi-laravel-breeze)
  - [3. Konfigurasi Database](#langkah-3--konfigurasi-database)
  - [4. Buat Model & Migration](#langkah-4--buat-model--migration)
  - [5. Buat Controller](#langkah-5--buat-controller)
  - [6. Konfigurasi Routes](#langkah-6--konfigurasi-routes)
  - [7. Buat Views (Blade)](#langkah-7--buat-views-blade)
  - [8. Jalankan Aplikasi](#langkah-8--jalankan-aplikasi)
- [Struktur Folder](#-struktur-folder)
- [Kontribusi](#-kontribusi)
- [Lisensi](#-lisensi)

---

## 📖 Tentang Proyek

**Perpustakaan Digital** adalah aplikasi web berbasis Laravel 12 yang memungkinkan pengelolaan buku, anggota, dan peminjaman secara digital. Aplikasi ini menggunakan **Laravel Breeze** untuk sistem autentikasi yang ringan dan cepat, serta **Tailwind CSS** untuk tampilan yang modern dan responsif.

---

## ✨ Fitur Utama

| Fitur | Deskripsi |
|-------|-----------|
| 🔐 Autentikasi | Login, Register, Reset Password (via Breeze) |
| 📚 Manajemen Buku | CRUD buku (judul, pengarang, kategori, stok) |
| 👤 Manajemen Anggota | Pendaftaran & pengelolaan data anggota |
| 📋 Peminjaman | Catat peminjaman & pengembalian buku |
| 🔍 Pencarian | Cari buku berdasarkan judul atau pengarang |
| 📊 Dashboard | Ringkasan statistik perpustakaan |

---

## 🔧 Prasyarat

Pastikan perangkat kamu sudah terinstal:

- **PHP** >= 8.2
- **Composer** >= 2.x
- **Node.js** >= 18.x & **NPM**
- **MySQL** >= 8.0 (atau MariaDB)
- **Git**

---

## 🚀 Cara Clone dari GitHub

Jika kamu ingin menggunakan proyek yang sudah ada di GitHub, ikuti langkah berikut:

### 1. Clone Repository

```bash
git clone https://github.com/username/perpustakaan-digital.git
```

> 💡 Ganti `username/perpustakaan-digital` dengan URL repository yang sebenarnya.

### 2. Masuk ke Direktori Proyek

```bash
cd perpustakaan-digital
```

### 3. Install Dependensi PHP

```bash
composer install
```

### 4. Install Dependensi JavaScript

```bash
npm install
```

### 5. Salin File Environment

```bash
cp .env.example .env
```

### 6. Generate Application Key

```bash
php artisan key:generate
```

### 7. Konfigurasi Database di `.env`

Buka file `.env` dan sesuaikan konfigurasi berikut:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpustakaan_digital
DB_USERNAME=root
DB_PASSWORD=
```

### 8. Jalankan Migration & Seeder

```bash
php artisan migrate --seed
```

### 9. Build Asset Frontend

```bash
npm run dev
```

### 10. Jalankan Server

```bash
php artisan serve
```

Akses aplikasi di: **http://localhost:8000** 🎉

---

## 🏗️ Langkah Pengerjaan

Panduan lengkap membangun aplikasi dari awal:

---

### Langkah 1 — Setup Proyek Laravel 12

Buat proyek Laravel baru menggunakan Composer:

```bash
composer create-project laravel/laravel perpustakaan-digital
cd perpustakaan-digital
```

Pastikan versi Laravel yang terinstal adalah **12.x**:

```bash
php artisan --version
```

---

### Langkah 2 — Instalasi Laravel Breeze

Laravel Breeze menyediakan autentikasi siap pakai (login, register, reset password).

#### a. Instal Breeze via Composer

```bash
composer require laravel/breeze --dev
```

#### b. Jalankan Installer Breeze

```bash
php artisan breeze:install
```

Pilih stack yang diinginkan saat muncul prompt:
- `blade` → untuk Blade + Tailwind CSS *(direkomendasikan untuk pemula)*
- `react` → untuk React + Inertia.js
- `vue` → untuk Vue + Inertia.js

#### c. Install Node Modules & Build

```bash
npm install
npm run dev
```

---

### Langkah 3 — Konfigurasi Database

#### a. Buat Database Baru

Buka **phpMyAdmin** atau MySQL CLI, lalu buat database:

```sql
CREATE DATABASE perpustakaan_digital;
```

#### b. Konfigurasi `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpustakaan_digital
DB_USERNAME=root
DB_PASSWORD=
```

#### c. Jalankan Migration Bawaan Breeze

```bash
php artisan migrate
```

> Ini akan membuat tabel `users`, `password_reset_tokens`, dan `sessions`.

---

### Langkah 4 — Buat Model & Migration

#### a. Model Buku

```bash
php artisan make:model Buku -m
```

Edit file migration `database/migrations/xxxx_create_bukus_table.php`:

```php
public function up(): void
{
    Schema::create('bukus', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->string('pengarang');
        $table->string('penerbit')->nullable();
        $table->year('tahun_terbit')->nullable();
        $table->string('kategori');
        $table->integer('stok')->default(0);
        $table->string('isbn')->unique()->nullable();
        $table->text('deskripsi')->nullable();
        $table->string('cover')->nullable();
        $table->timestamps();
    });
}
```

#### b. Model Peminjaman

```bash
php artisan make:model Peminjaman -m
```

Edit migration `database/migrations/xxxx_create_peminjamans_table.php`:

```php
public function up(): void
{
    Schema::create('peminjamans', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('buku_id')->constrained('bukus')->onDelete('cascade');
        $table->date('tanggal_pinjam');
        $table->date('tanggal_kembali');
        $table->date('tanggal_dikembalikan')->nullable();
        $table->enum('status', ['dipinjam', 'dikembalikan', 'terlambat'])->default('dipinjam');
        $table->timestamps();
    });
}
```

#### c. Jalankan Migration

```bash
php artisan migrate
```

---

### Langkah 5 — Buat Controller

#### a. Controller Buku (Resource)

```bash
php artisan make:controller BukuController --resource
```

Isi `app/Http/Controllers/BukuController.php`:

```php
<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::latest()->paginate(10);
        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        return view('buku.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'kategori'  => 'required|string',
            'stok'      => 'required|integer|min:0',
        ]);

        Buku::create($request->all());

        return redirect()->route('buku.index')
                         ->with('success', 'Buku berhasil ditambahkan!');
    }

    public function show(Buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'kategori'  => 'required|string',
            'stok'      => 'required|integer|min:0',
        ]);

        $buku->update($request->all());

        return redirect()->route('buku.index')
                         ->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')
                         ->with('success', 'Buku berhasil dihapus!');
    }
}
```

#### b. Controller Dashboard

```bash
php artisan make:controller DashboardController
```

```php
<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBuku      = Buku::count();
        $totalAnggota   = User::count();
        $totalDipinjam  = Peminjaman::where('status', 'dipinjam')->count();
        $terlambat      = Peminjaman::where('status', 'terlambat')->count();

        return view('dashboard', compact(
            'totalBuku', 'totalAnggota', 'totalDipinjam', 'terlambat'
        ));
    }
}
```

---

### Langkah 6 — Konfigurasi Routes

Edit file `routes/web.php`:

```php
<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;

// Halaman utama redirect ke dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Routes yang membutuhkan autentikasi
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
         ->name('dashboard');

    // CRUD Buku
    Route::resource('buku', BukuController::class);

    // CRUD Peminjaman
    Route::resource('peminjaman', PeminjamanController::class);

});

// Routes Breeze (login, register, dll)
require __DIR__.'/auth.php';
```

---

### Langkah 7 — Buat Views (Blade)

#### a. Struktur Folder Views

```
resources/views/
├── auth/               ← otomatis dibuat Breeze
├── layouts/
│   └── app.blade.php   ← layout utama
├── buku/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── show.blade.php
├── peminjaman/
│   ├── index.blade.php
│   └── create.blade.php
└── dashboard.blade.php
```

#### b. Contoh View `buku/index.blade.php`

```html
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Buku
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Tombol Tambah --}}
                <a href="{{ route('buku.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">
                    + Tambah Buku
                </a>

                {{-- Tabel Buku --}}
                <table class="w-full text-sm mt-4">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">No</th>
                            <th class="p-3 text-left">Judul</th>
                            <th class="p-3 text-left">Pengarang</th>
                            <th class="p-3 text-left">Kategori</th>
                            <th class="p-3 text-left">Stok</th>
                            <th class="p-3 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bukus as $buku)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3">{{ $loop->iteration }}</td>
                            <td class="p-3">{{ $buku->judul }}</td>
                            <td class="p-3">{{ $buku->pengarang }}</td>
                            <td class="p-3">{{ $buku->kategori }}</td>
                            <td class="p-3">{{ $buku->stok }}</td>
                            <td class="p-3 space-x-2">
                                <a href="{{ route('buku.edit', $buku) }}"
                                   class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('buku.destroy', $buku) }}"
                                      method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:underline"
                                            onclick="return confirm('Hapus buku ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $bukus->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
```

---

### Langkah 8 — Jalankan Aplikasi

#### a. Jalankan semua service

Buka **2 terminal** secara bersamaan:

**Terminal 1 — Laravel Server:**
```bash
php artisan serve
```

**Terminal 2 — Vite (Frontend):**
```bash
npm run dev
```

#### b. Akses Aplikasi

Buka browser dan kunjungi:

```
http://localhost:8000
```

#### c. Akun Default (jika menggunakan seeder)

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@perpustakaan.com | password |
| Anggota | anggota@perpustakaan.com | password |

---

## 📁 Struktur Folder

```
perpustakaan-digital/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── BukuController.php
│   │       ├── DashboardController.php
│   │       └── PeminjamanController.php
│   └── Models/
│       ├── Buku.php
│       ├── Peminjaman.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── buku/
│       ├── peminjaman/
│       └── dashboard.blade.php
├── routes/
│   └── web.php
├── .env.example
└── README.md
```

---

## 🤝 Kontribusi

Kontribusi sangat disambut! Silakan ikuti langkah berikut:

1. **Fork** repository ini
2. Buat branch fitur baru: `git checkout -b fitur/nama-fitur`
3. Commit perubahan: `git commit -m 'Tambah fitur nama-fitur'`
4. Push ke branch: `git push origin fitur/nama-fitur`
5. Buat **Pull Request**

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT) — bebas digunakan untuk keperluan belajar maupun produksi.

---

<div align="center">

Dibuat dengan ❤️ menggunakan **Laravel 12** & **Breeze**

</div>
