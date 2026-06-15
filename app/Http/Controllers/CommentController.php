<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Menampilkan semua komentar di halaman Dashboard Admin
     */
    public function index()
    {
        // Mengambil semua komentar berikut data post terkait, diurutkan dari yang terbaru
        $comments = Comment::with('post')->latest()->get();

        // Mengarahkan ke file view admin yang barusan kamu kirim kodenya
        return view('comments', compact('comments'));
    }

    /**
     * Menyimpan komentar baru dari pengunjung web
     */
    public function store(Request $request, $postId)
    {
        if (!Auth::check()) {
            return back()->with('error', 'Kamu harus login terlebih dahulu untuk mengirim komentar!');
        }

        $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        Comment::create([
            'post_id' => $postId,
            'user_id' => Auth::id(),
            'comment' => $request->body,
            'name'    => Auth::user()->name,  
            'email'   => Auth::user()->email, 
        ]);

        return back()->with('success', 'Komentar kamu berhasil diterbitkan!');
    }

    /**
     * Menghapus komentar lewat tombol aksi di Dashboard Admin
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Komentar pengunjung berhasil dihapus!');
    }
}