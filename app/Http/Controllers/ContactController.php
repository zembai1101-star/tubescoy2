<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // 1. Menampilkan Halaman Form Contact ke Pengunjung Publik
    public function index()
    {
        return view('contact');
    }

    // 2. Memproses Data Form yang Dikirim Pengunjung
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Pesan kamu berhasil dikirim! Terima kasih.');
    }

    // 3. Menampilkan Semua Pesan Masuk di Admin Panel
    // Sesuaikan bagian view-nya menjadi seperti ini:
    public function adminIndex()
    {
        $contacts = Contact::latest()->get();

        return view('messages', compact('contacts'));
    }

    // 4. Menghapus Pesan di Admin Panel
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->back()->with('success', 'Pesan berhasil dihapus.');
    }
}