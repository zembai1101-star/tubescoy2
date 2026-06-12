<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment; // <-- WAJIB IMPORT MODEL COMMENT
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Menampilkan semua daftar komentar di Admin Panel
     */
    public function index()
    {
        // Mengambil komentar terbaru beserta data artikel (post) terkait.
        // Menggunakan whereHas agar jika ada artikel yang telanjur dihapus, komentarnya tidak bikin web crash.
        $comments = Comment::whereHas('post')->with('post')->latest()->get();

        // Mengirim data ke halaman resources/views/comments.blade.php
        return view('comments', compact('comments'));
    }

    /**
     * Menghapus komentar toxic atau spam
     */
    public function destroy($id)
    {
        // Cari data komentar berdasarkan ID, jika tidak ada langsung lempar eror 404
        $comment = Comment::findOrFail($id);
        
        // Eksekusi hapus dari database
        $comment->delete();

        // Kembalikan ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Komentar netizen yang toxic berhasil dimusnahkan!');
    }
}