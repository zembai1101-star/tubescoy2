<?php

namespace App\Http\Controllers;

use App\Models\User; // <-- Wajib di-import untuk proses register
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // <-- Wajib di-import untuk enkripsi password register

class AuthController extends Controller
{
    // 1. Menampilkan halaman form login
    public function showLogin()
    {
        // Jika admin ternyata sudah login, langsung lempar ke dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.login');
    }

    // 2. Memproses data dari form login
    public function login(Request $request)
    {
        // Validasi inputan form
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek kecocokan email & password di database + fitur remember me
        if (Auth::attempt($credentials, $request->has('remember'))) {
            // Jika sukses cocok, buat ulang session baru (keamanan)
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang kembali, Admin!');
        }

        // Jika salah email/password, kembalikan ke form login bawa pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang kamu masukkan salah.',
        ])->onlyInput('email');
    }

    // 3. Menampilkan halaman form register
    public function showRegister()
    {
        // Jika sudah login, ngapain register lagi? Lempar ke dashboard
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('auth.register');
    }

    // 4. Memproses data registrasi admin/member baru
    public function register(Request $request)
    {
        // Validasi input form registrasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed', // 'confirmed' otomatis ngecek input password_confirmation
        ]);

        // Masukkan data ke database tabel users
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password biar aman
        ]);

        // Berhasil daftar, lempar ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    // 5. Fitur Keluar / Logout Admin
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index.home')->with('success', 'Berhasil logout.');
    }
}