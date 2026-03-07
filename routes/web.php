<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Petugas\PetugasDashboardController;
use App\Http\Controllers\User\UserBookController;
use App\Http\Controllers\User\UserBorrowingController;
use App\Http\Controllers\User\UserFavoriteController;
use App\Http\Controllers\User\UserRatingController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Petugas\PetugasBorrowingController;
use App\Http\Controllers\Admin\AdminBorrowingController;
use App\Http\Controllers\Admin\AdminRatingController;
use App\Http\Controllers\HomeController;

Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
        ->name('user.dashboard');

    // lihat buku
    Route::get('/user/books', [UserBookController::class, 'index'])
        ->name('user.books');

    // halaman form peminjaman
    Route::get('/user/borrow/{book}', [UserBorrowingController::class, 'create'])
        ->name('user.borrow.create');

    // submit peminjaman
    Route::post('/user/borrow/{book}', [UserBorrowingController::class, 'store'])
        ->name('user.borrow.confirm'); // ganti nama route supaya beda dari create

    // kembalikan buku
    Route::post('/user/return/{borrowing}', [UserBorrowingController::class, 'return'])
        ->name('user.return');

    // kembalikan buku
    Route::post('/user/return/{borrowing}', [UserBorrowingController::class, 'return'])
        ->name('user.return');

    // favorit
    Route::post('/user/favorite/{book}', [UserFavoriteController::class, 'store'])
        ->name('user.favorite');

    Route::get('/user/favorites', [UserFavoriteController::class, 'index'])
        ->name('user.favorites');

    Route::delete('/user/favorite/{book}', [UserFavoriteController::class, 'destroy'])
        ->name('user.favorite.destroy');

    // rating
    Route::post('/user/rating/{book}', [UserRatingController::class, 'store'])
        ->name('user.rating');

    Route::get('/user/borrow/{borrowing}/return',
    [UserBorrowingController::class, 'returnPage'])
    ->name('user.borrow.return.page');

    Route::patch('/user/borrow/{borrowing}/return',
    [UserBorrowingController::class, 'return'])
    ->name('user.borrow.return');

    Route::post('/user/favorite/{book}', 
        [UserFavoriteController::class, 'store']
    )->name('user.favorite.store');

    Route::delete('/user/favorite/{book}', 
        [UserFavoriteController::class, 'destroy']
    )->name('user.favorite.destroy');
    
    Route::get('/borrowing',
        [\App\Http\Controllers\User\BorrowingHistoryController::class, 'index']
    )->name('user.borrowing.index');

    Route::get('/borrowing/{borrowing}',
        [\App\Http\Controllers\User\BorrowingHistoryController::class, 'show']
    )->name('user.borrowing.show');

});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');

    // manajemen akun
    Route::get('/users', [UserManagementController::class, 'index'])
        ->name('users');

    Route::get('/users/create', [UserManagementController::class, 'create'])
        ->name('users.create');

    Route::post('/users', [UserManagementController::class, 'store'])
        ->name('users.store');

    Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])
            ->name('users.edit');

        Route::put('/users/{user}', [UserManagementController::class, 'update'])
            ->name('users.update');

            // ⭐ TAMBAHKAN INI
        Route::get('/users/{user}', [UserManagementController::class, 'show'])
            ->name('users.show');

    Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])
        ->name('users.destroy');
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);

    Route::resource('books', \App\Http\Controllers\Admin\BookController::class);

    Route::get('/borrowings', [AdminBorrowingController::class, 'index'])
        ->name('borrowings.index');

    Route::get('/borrowings/{borrowing}', [AdminBorrowingController::class, 'show'])
        ->name('borrowings.show');

    Route::patch('/user/borrow/{id}/return', [UserBorrowingController::class, 'returnBook'])
        ->name('user.borrow.return');

    Route::post('/books/{book}/rating',
        [UserRatingController::class, 'store']
    )->name('user.ratings.store');

    Route::get('/ratings', [AdminRatingController::class, 'index'])
            ->name('ratings.index');

        Route::get('/ratings/{rating}', [AdminRatingController::class, 'show'])
            ->name('ratings.show');

        Route::get('/ratings/{rating}/edit', [AdminRatingController::class, 'edit'])
            ->name('ratings.edit');

        Route::put('/ratings/{rating}', [AdminRatingController::class, 'update'])
            ->name('ratings.update');

        Route::delete('/ratings/{rating}', [AdminRatingController::class, 'destroy'])
            ->name('ratings.destroy');
});

Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        // ======================
        // DASHBOARD
        // ======================
        Route::get('/dashboard', [PetugasDashboardController::class, 'index'])
            ->name('dashboard');

        // ======================
        // BORROWINGS (PEMINJAMAN)
        // ======================

        // index (riwayat)
        Route::get('/borrowings', [PetugasBorrowingController::class, 'index'])
            ->name('borrowings.index');

        // show (detail)
        Route::get('/borrowings/{borrowing}', [PetugasBorrowingController::class, 'show'])
            ->name('borrowings.show');

        // edit
        Route::get('/borrowings/{borrowing}/edit', [PetugasBorrowingController::class, 'edit'])
            ->name('borrowings.edit');

        // update
        Route::put('/borrowings/{borrowing}', [PetugasBorrowingController::class, 'update'])
            ->name('borrowings.update');

        // delete
        Route::delete('/borrowings/{borrowing}', [PetugasBorrowingController::class, 'destroy'])
            ->name('borrowings.destroy');

        // approve
        Route::post('/borrowings/{borrowing}/approve', [PetugasBorrowingController::class, 'approve'])
            ->name('borrowings.approve');

        // reject
        Route::post('/borrowings/{borrowing}/reject', [PetugasBorrowingController::class, 'reject'])
            ->name('borrowings.reject');

        // ======================
        // BOOKS
        // ======================
        Route::resource(
            'books',
            \App\Http\Controllers\Petugas\BookController::class
        );
    });

        
require __DIR__.'/auth.php';
