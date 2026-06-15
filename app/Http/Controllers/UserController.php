<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Menampilkan semua akun user di halaman dashboard admin
     */
    public function index()
    {
        // Mengambil semua user dari database, diurutkan dari yang paling baru daftar
        $users = User::latest()->get();

        // Melempar data ke file view users.blade.php kamu
        return view('users', compact('users'));
    }

    /**
     * Mengedit Username / Nama Akun User
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name
        ]);

        return back()->with('success', 'Nama akun user berhasil diperbarui!');
    }

    /**
     * Menghapus Akun User (Admin dilarang menghapus akunnya sendiri)
     */
    public function destroy($id)
    {
        // Proteksi: Mencegah admin yang sedang login menghapus dirinya sendiri secara tidak sengaja
        if (Auth::id() == $id) {
            return back()->with('error', 'Kamu tidak bisa menghapus akun kamu sendiri yang sedang aktif!');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Akun user berhasil dihapus permanen!');
    }
}