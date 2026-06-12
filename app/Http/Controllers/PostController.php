<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Menampilkan semua artikel di halaman utama artikel (Publish)
    public function index()
    {
        $posts = Post::with(['category', 'tags'])->where('status', 'publish')->latest()->get();
        return view('posts', compact('posts'));
    }

    // Menampilkan semua artikel yang masih berupa Draft
    public function draft()
    {
        $posts = Post::with(['category', 'tags'])->where('status', 'draft')->latest()->get();
        return view('posts', compact('posts'));
    }

    // Menampilkan halaman form tulis artikel baru
    public function create()
    {
        $categories = Category::where('type', 'category')->get();
        $tags = Category::where('type', 'tag')->get();

        return view('posts-create', compact('categories', 'tags'));
    }

    // Menyimpan data artikel baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'status' => 'required|in:publish,draft',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // Sesuai kodingan asli kamu, ditulis manual satu per satu + disisipkan image
        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->input('content'),
            'status' => $request->status,
            'category_id' => $request->category_id, // Kategori kamu tetap ada di sini!
            'image' => $request->hasFile('image') ? $request->file('image')->store('uploads/posts', 'public') : null
        ]);

        // Menyimpan hubungan relasi Many-to-Many ke tabel pivot post_tag
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags); // Tag kamu tetap aman diproses di sini!
        }

        if ($request->status == 'draft') {
            return redirect()->route('posts.draft')->with('success', 'Artikel dan gambar disimpan sebagai draft!');
        }

        return redirect()->route('posts.index')->with('success', 'Artikel baru berhasil diterbitkan dengan kategori dan tag!');
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
        $tags = Category::where('type', 'tag')->get();

        return view('posts-edit', compact('post', 'categories', 'tags'));
    }

    // Memperbarui data artikel di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'status' => 'required|in:publish,draft',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        $post = Post::findOrFail($id);

        // Menyiapkan data teks untuk diupdate
        $updateData = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->input('content'),
            'status' => $request->status,
            'category_id' => $request->category_id, // Kategori aman ter-update
        ];

        // Logika kelola foto saat update
        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            $updateData['image'] = $request->file('image')->store('uploads/posts', 'public');
        }

        $post->update($updateData);

        // Menyinkronkan ulang data tag
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags); // Tag aman tersinkronisasi kembali
        } else {
            $post->tags()->detach();
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

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->back()->with('success', 'Artikel berhasil dihapus!');
    }

    public function blogShow($slug)
    {
        // Cari artikel di database yang slug-nya cocok
        $post = Post::with(['category', 'tags'])->where('slug', $slug)->firstOrFail();

        // Lempar data artikel tersebut ke file view bernama blog-detail.blade.php
        return view('blog-detail', compact('post'));
    }

    // Tambahan Fungsi Tampilan Home Pengunjung (Eden Theme)
    public function blogHome()
    {
        // Mengambil semua artikel berstatus publish
        $posts = Post::with(['category', 'tags'])
                     ->where('status', 'publish')
                     ->latest()
                     ->get();
                     
        return view('blog-home', compact('posts'));
    }
}