<?php

use Illuminate\Support\Facades\Route;

// ==========================================================
// KELOMPOK IMPORT CONTROLLER
// ==========================================================
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\CommentController;

// ==========================================================
// 1. DASHBOARD UTAMA ADMIN
// ==========================================================
Route::get('/', function () {
    return view('dashboard');
})->name('admin.dashboard');


// ==========================================================
// 2. TEMPLATE EDEN / HALAMAN DEPAN PUBLIK (Frontend)
// ==========================================================
// Rute utama halaman depan (menangani pencarian juga)
Route::get('/home', [PostController::class, 'blogHome'])->name('index.home');

// Rute untuk melihat detail artikel berdasarkan slug-nya (Ditaruh di sini agar aman)
Route::get('/blog/{slug}', [PostController::class, 'blogShow'])->name('blog.show');

// Rute detail artikel alternatif bawaan kamu
Route::get('/home/{slug}', [PostController::class, 'blogShow'])->name('blog.show.alt');


// ==========================================================
// 3. MANAJEMEN KONTEN (PANEL ADMIN)
// ==========================================================

// --- Artikel / Post ---
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/draft', [PostController::class, 'draft'])->name('posts.draft');
Route::put('/posts/{id}/publish', [PostController::class, 'publish'])->name('posts.publish');

// --- Kategori & Tag ---
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// --- Galeri Media ---
Route::get('/media', [MediaController::class, 'index'])->name('media.index');
Route::post('/media', [MediaController::class, 'store'])->name('media.store');
Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('media.destroy');

// --- CRUD Halaman Statis ---
Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
Route::post('/pages/store', [PageController::class, 'store'])->name('pages.store');
Route::put('/pages/{id}', [PageController::class, 'update'])->name('pages.update');
Route::delete('/pages/{id}', [PageController::class, 'destroy'])->name('pages.destroy');


// ==========================================================
// 4. INTERAKSI & PENGUNJUNG
// ==========================================================

// --- Komentar ---
Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

// --- Pesan Kontak ---
Route::get('/messages', function () { return view('messages'); })->name('messages.index');


// ==========================================================
// 5. PENGATURAN SISTEM
// ==========================================================
Route::get('/users', function () { return view('users'); })->name('users.index');
Route::get('/settings', function () { return view('settings'); })->name('settings.index');


// ==========================================================
// 6. RUTE DINAMIS SAPU JAGAT (WAJIB PALING BAWAH / AKHIR FILE!)
// ==========================================================
use App\Http\Controllers\ContactController;

// 1. TARUH RUTE KONTAK DI ATAS
// Rute untuk Publik (Halaman Publik)
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// Pastikan URL-nya adalah '/messages' sesuai dengan yang dipanggil sidebar kamu!
Route::get('/messages', [ContactController::class, 'adminIndex'])->name('messages.index');

// Rute untuk hapus pesan
Route::delete('/messages/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');


// 2. TARUH RUTE SLUG INI DI PALING BAWAH FILE WEB.PHP (Beneran paling bawah setelah rute lain selesai)
Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show');