<?php

use Illuminate\Support\Facades\Route;

// PASTIKAN JALURNYA DITULIS LENGKAP SEPERTI INI:
use App\Http\Controllers\PageController;
// ==========================================================
// 1. DASHBOARD UTAMA
// ==========================================================
Route::get('/', function () {
    return view('dashboard');
})->name('admin.dashboard');


// ==========================================================
// 2. MANAJEMEN KONTEN
// ==========================================================

use App\Http\Controllers\PostController;

// --- Artikel / Post ---
// 1. Menampilkan Semua Artikel (Publish)
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// 2. Menampilkan Form Tulis Artikel Baru (Menggunakan Controller)
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

// 3. Menampung Data Form saat Klik Tombol Simpan (Method POST)
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');

// 6. Menampilkan halaman form edit artikel
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');

// 7. Menyimpan perubahan data artikel (Method PUT)
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');

// 8. Menghapus data artikel (Method DELETE)
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

// 4. Menampilkan Semua Artikel yang Masih Berstatus Draft
Route::get('/posts/draft', [PostController::class, 'draft'])->name('posts.draft');

// 5. DI SINI TEMPATNYA: Mengubah status draft menjadi publish otomatis (Method PUT)
Route::put('/posts/{id}/publish', [PostController::class, 'publish'])->name('posts.publish');


// --- Kategori & Galeri Media ---
Route::get('/categories', function () { return view('categories'); })->name('categories.index');
Route::get('/media', function () { return view('media'); })->name('media.index');

// --- CRUD Halaman Statis (Disinkronkan dengan deklarasi USE di atas) ---
Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
Route::post('/pages/store', [PageController::class, 'store'])->name('pages.store');
Route::put('/pages/{id}', [PageController::class, 'update'])->name('pages.update');
Route::delete('/pages/{id}', [PageController::class, 'destroy'])->name('pages.destroy');
// Wajib ditaruh di paling bawah file agar tidak memblokir URL admin
Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show');

// ==========================================================
// 3. INTERAKSI & PENGUNJUNG
// ==========================================================
Route::get('/comments', function () { return view('comments'); })->name('comments.index');
Route::get('/messages', function () { return view('messages'); })->name('messages.index');


// ==========================================================
// 4. PENGATURAN SISTEM
// ==========================================================
Route::get('/users', function () { return view('users'); })->name('users.index');
Route::get('/settings', function () { return view('settings'); })->name('settings.index');

use App\Http\Controllers\CategoryController;

// --- Kategori & Tag ---
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update'); // <-- TAMBAHKAN INI
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

use App\Http\Controllers\MediaController;

Route::get('/media', [MediaController::class, 'index'])->name('media.index');
Route::post('/media', [MediaController::class, 'store'])->name('media.store');
Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('media.destroy');