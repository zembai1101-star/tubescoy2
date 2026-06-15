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
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\UserController; // <-- 1. SUDAH GUE IMPORT BIAR GA EROR TARGET CLASS DOES NOT EXIST!

// ==========================================================
// A. KELOMPOK ROUTE PUBLIK / FRONTEND (Bisa Diakses Siapa Saja)
// ==========================================================
Route::get('/', [PostController::class, 'blogHome'])->name('index.home');
Route::get('/home', [PostController::class, 'blogHome'])->name('index.home.alt');
Route::get('/blog/{slug}', [PostController::class, 'blogShow'])->name('blog.show');
Route::get('/home/{slug}', [PostController::class, 'blogShow'])->name('blog.show.alt');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// ==========================================================
// RUTE AUTENTIKASI (LOGIN & LOGOUT)
// ==========================================================
Route::get('/rahasia-admin', [AuthController::class, 'showLogin'])->name('login');
Route::post('/rahasia-admin', [AuthController::class, 'login'])->name('login.proses');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/daftar-admin', [AuthController::class, 'showRegister'])->name('register');
Route::post('/daftar-admin', [AuthController::class, 'register'])->name('register.proses');


// ==========================================================
// B. PANEL ADMIN (GEMBOK KEAMANAN AKTIF)
// ==========================================================
Route::middleware(['is_admin'])->group(function () {

    // 1. Dashboard Utama Admin
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('admin.dashboard');

    // 2. Manajemen Konten (Artikel / Post)
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/draft', [PostController::class, 'draft'])->name('posts.draft');
    Route::put('/posts/{id}/publish', [PostController::class, 'publish'])->name('posts.publish');

    // 3. Kategori & Tag
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // 4. Galeri Media
    Route::get('/media', [MediaController::class, 'index'])->name('media.index');
    Route::post('/media', [MediaController::class, 'store'])->name('media.store');
    Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('media.destroy');

    // 5. CRUD Halaman Statis di Admin
    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    Route::post('/pages/store', [PageController::class, 'store'])->name('pages.store');
    Route::put('/pages/{id}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('/pages/{id}', [PageController::class, 'destroy'])->name('pages.destroy');

    // 6. Interaksi Pengunjung (Komentar & Pesan Kontak)
    Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/messages', [ContactController::class, 'adminIndex'])->name('messages.index');
    Route::delete('/messages/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.destroy');

    // 7. Kelola User / Penulis (Dinamis dari Controller)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    // 8. Pengaturan Sistem
    // RUTE /USERS YANG MENDUPLIKAT DAN MERUSAK DI SINI SUDAH GUE APUS CUY!
    Route::get('/settings', function () {
        return view('settings');
    })->name('settings.index');
});


// ==========================================================
// C. RUTE DINAMIS SAPU JAGAT (WAJIB PALING BAWAH / AKHIR FILE!)
// ==========================================================
Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show');

// Rute khusus untuk memproses pengiriman komentar berdasarkan ID Artikel
Route::post('/post/{id}/comment', [CommentController::class, 'store'])->name('comment.store');