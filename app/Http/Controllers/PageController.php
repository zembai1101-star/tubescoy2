<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    // READ: Menampilkan Semua Data Halaman di Admin Panel
    public function index()
    {
        $pages = Page::latest()->get();
        return view('pages', compact('pages'));
    }

    // CREATE: Menyimpan Data Baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        Page::create([
            'title'   => $request->title,
            'slug'    => Str::slug($request->title),
            'content' => $request->input('content'), 
        ]);

        return redirect()->back()->with('success', 'Halaman berhasil ditambahkan!');
    }

    // UPDATE: Menyimpan Perubahan Edit
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
        ]);

        $page = Page::findOrFail($id);
        
        $page->update([
            'title'   => $request->title,
            'slug'    => Str::slug($request->title),
            'content' => $request->input('content'), 
        ]);

        return redirect()->back()->with('success', 'Halaman berhasil diperbarui!');
    }

    // DELETE: Menghapus Data
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        return redirect()->back()->with('success', 'Halaman berhasil dihapus!');
    }

    // =========================================================================
    // TAMBAHAN BARU: Menampilkan Halaman Statis di Sisi Depan Blog (Front-end)
    // =========================================================================
    public function show($slug)
    {
        // Mencari halaman berdasarkan slug, jika tidak ada otomatis memunculkan 404
        $page = Page::where('slug', $slug)->firstOrFail();

        // Mengirim data ke view pembaca
        return view('page-detail', compact('page'));
    }
}