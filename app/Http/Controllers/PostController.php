<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category; // Membaca model kategori & tag
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Menampilkan semua artikel di halaman utama artikel (Publish)
    public function index()
    {
        // Ditambahkan dengan eager loading relasi category dan tags
        $posts = Post::with(['category', 'tags'])->where('status', 'publish')->latest()->get();
        return view('posts', compact('posts'));
    }

    // Menampilkan semua artikel yang masih berupa Draft
    public function draft()
    {
        // Ditambahkan dengan eager loading relasi category dan tags
        $posts = Post::with(['category', 'tags'])->where('status', 'draft')->latest()->get();
        return view('posts', compact('posts'));
    }

    // Menampilkan halaman form tulis artikel baru
    public function create()
    {
        $categories = Category::where('type', 'category')->get();
        $tags = Category::where('type', 'tag')->get(); // Mengambil data tag untuk form
        
        return view('posts-create', compact('categories', 'tags'));
    }

    // Menyimpan data artikel baru ke database
    public function store(Request $request)
    {
        // Ditambahkan validasi array untuk tags
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required',
            'status'      => 'required|in:publish,draft',
            'category_id' => 'nullable|exists:categories,id',
            'tags'        => 'nullable|array',
            'tags.*'      => 'exists:categories,id'
        ]);

        $post = Post::create([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'content'     => $request->input('content'),
            'status'      => $request->status,
            'category_id' => $request->category_id,
        ]);

        // Menyimpan hubungan relasi Many-to-Many ke tabel pivot post_tag
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        // Jika disimpan sebagai draft, arahkan ke halaman draft
        if ($request->status == 'draft') {
            return redirect()->route('posts.draft')->with('success', 'Artikel disimpan sebagai draft!');
        }

        // Jika dipublish, arahkan ke semua artikel
        return redirect()->route('posts.index')->with('success', 'Artikel berhasil diterbitkan!');
    }

    // Fungsi untuk mengubah status draft menjadi publish otomatis
    public function publish($id)
    {
        $post = Post::findOrFail($id);
        $post->update([
            'status' => 'publish'
        ]);

        return redirect()->route('posts.index')->with('success', 'Artikel draft berhasil diterbitkan!');
    }

    // Menampilkan halaman edit beserta data artikel lama
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::where('type', 'category')->get(); 
        $tags = Category::where('type', 'tag')->get(); // Mengambil data tag untuk form edit
        
        return view('posts-edit', compact('post', 'categories', 'tags'));
    }

    // Memperbarui data artikel di database
    public function update(Request $request, $id)
    {
        // Ditambahkan validasi array untuk tags di update
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required',
            'status'      => 'required|in:publish,draft',
            'category_id' => 'nullable|exists:categories,id',
            'tags'        => 'nullable|array',
            'tags.*'      => 'exists:categories,id'
        ]);

        $post = Post::findOrFail($id);
        $post->update([
            'title'       => $request->title,
            'slug'        => Str::slug($request->title),
            'content'     => $request->input('content'),
            'status'      => $request->status,
            'category_id' => $request->category_id,
        ]);

        // Menyinkronkan ulang data tag (menghapus yang lama, memasukkan yang baru dipilih)
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach(); // Menghapus semua tag jika tidak ada yang dicentang
        }

        if ($post->status == 'draft') {
            return redirect()->route('posts.draft')->with('success', 'Artikel berhasil diperbarui sebagai draft!');
        }

        return redirect()->route('posts.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    // Menghapus artikel dari database
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->back()->with('success', 'Artikel berhasil dihapus!');
    }
}