<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    // Tampilkan galeri media
    public function index()
    {
        $gallery = Media::latest()->get();
        return view('media', compact('gallery'));
    }

    // Proses Simpan/Upload Gambar Baru
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048', // Batas maksimal 2MB
        ]);

        if ($request->file('image')) {
            $file = $request->file('image');
            $originalName = $file->getClientOriginalName();
            $fileSize = $file->getSize();
            $fileType = $file->getClientMimeType();
            
            // Simpan gambar ke folder storage/app/public/uploads
            $path = $file->store('uploads', 'public');

            // Simpan data log gambarnya ke database
            Media::create([
                'filename' => basename($path),
                'original_name' => $originalName,
                'filepath' => '/storage/' . $path,
                'filetype' => $fileType,
                'filesize' => $fileSize,
            ]);

            return redirect()->back()->with('success', 'Gambar berhasil diunggah ke galeri!');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah gambar.');
    }

    // Proses Hapus Gambar
    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        // Hapus file fisik aslinya dari dalam folder storage
        $relativePath = str_replace('/storage/', '', $media->filepath);
        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }

        // Hapus record datanya dari tabel database
        $media->delete();

        return redirect()->back()->with('success', 'Gambar berhasil dihapus dari galeri!');
    }
}