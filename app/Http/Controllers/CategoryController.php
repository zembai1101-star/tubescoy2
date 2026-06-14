<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Menampilkan halaman kategori & tag
    public function index()
    {
        // Pisahkan data kategori dan tag untuk dilempar ke satu halaman view
        $categories = Category::where('type', 'category')->latest()->get();
        $tags = Category::where('type', 'tag')->latest()->get();

        return view('categories', compact('categories', 'tags'));
    }

    // Menyimpan data Kategori atau Tag baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:category,tag',
        ]);

        // Terapkan logika anti-bentrok juga saat membuat data baru biar adil
        $slug = Str::slug($request->name);
        $cek_slug = Category::where('slug', $slug)->exists();

        if ($cek_slug) {
            $slug = $slug . '-' . rand(100, 999);
        }

        Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'type' => $request->type,
        ]);

        return redirect()->back()->with('success', ucfirst($request->type) . ' berhasil ditambahkan!');
    }

    // Menghapus data Kategori atau Tag
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }

    // Memperbarui nama kategori atau tag (SUDAH DIGABUNG DENGAN LOGIKA ANTI-BENTROK)
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        
        // Buat slug dasar dari nama inputan
        $slug = Str::slug($request->name);

        // TRIK ANTI BENTROK: Cek apakah slug ini sudah dipakai oleh KATEGORI LAIN
        $cek_slug = Category::where('slug', $slug)->where('id', '!=', $id)->exists();

        // Kalau ternyata sudah ada yang pakai, kita tambahkan angka random di belakangnya
        if ($cek_slug) {
            $slug = $slug . '-' . rand(100, 999); 
        }

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        // Menggunakan redirect()->back() agar posisi halaman admin tidak loncat, tetap di tempat semula
        return redirect()->back()->with('success', 'Kategori/Tag berhasil diperbarui!');
    }
}