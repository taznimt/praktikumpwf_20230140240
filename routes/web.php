<?php

use App\Http\Controllers\ProfileController; // Mengimpor ProfileController
use Illuminate\Support\Facades\Route;       // Mengimpor Facade Route
use App\Http\Controllers\AboutController;    // Mengimpor AboutController
use App\Http\Controllers\ProductController;  // Mengimpor ProductController
use App\Http\Controllers\CategoryController; // Mengimpor CategoryController

// Rute untuk halaman utama
Route::get('/', function () {
    return view('welcome'); // Menampilkan view 'welcome'
});

// Rute halaman about yang diarahkan ke method 'index' pada AboutController
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Rute dashboard, dilindungi middleware 'auth' dan 'verified', diberi nama 'dashboard'
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup rute yang membutuhkan autentikasi (user harus login)
Route::middleware('auth')->group(function () {
    
    // Rute untuk mengedit profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Rute untuk memperbarui data profil (method PATCH)
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Rute untuk menghapus akun profil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Membuat semua rute resource (index, create, store, show, edit, update, destroy) untuk product
    Route::resource('product', ProductController::class);

    // Membuat rute resource untuk category dengan proteksi tambahan middleware 'can:manage-category' (hanya admin/user berizin)
    Route::resource('category', CategoryController::class)->middleware('can:manage-category');
});

// Memuat file rute autentikasi bawaan (login, register, password reset, dll)
require __DIR__.'/auth.php';