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

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
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
    // Memperbarui nama kategori atau tag
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'slug' => \Illuminate\Support\Str::slug($request->name),
        ]);

        return redirect()->back()->with('success', 'Perubahan berhasil disimpan!');
    }
}