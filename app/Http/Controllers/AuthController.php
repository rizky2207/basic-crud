<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showRegistrationForm()
    {
        if (auth()->check()) {
            // Jika pengguna sudah terotentikasi, arahkan mereka ke halaman beranda atau halaman lainnya
            return redirect()->route('contact.index');
        }

        // Jika belum terotentikasi, tampilkan formulir registrasi
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validasi data yang dikirim oleh pengguna
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Buat pengguna baru berdasarkan data yang telah divalidasi
        $user = User::create($validatedData);

        // Setelah registrasi berhasil, arahkan pengguna ke tampilan login dengan pesan sukses
        return redirect()->route('login.show')->with('message', 'Registrasi successful');
    }

    public function showLoginForm()
    {
        if (auth()->check()) {
            // Jika pengguna sudah terotentikasi, arahkan mereka ke halaman beranda atau halaman lainnya
            return redirect()->route('contact.index');
        }

        // Jika belum terotentikasi, tampilkan formulir login
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi data yang dikirim oleh pengguna
        $validatedData = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);


        // Lakukan upaya untuk mengotentikasi pengguna
        if (auth()->attempt($validatedData)) {
            // Jika pengguna berhasil masuk, arahkan ke halaman beranda atau halaman yang sesuai
            return redirect()->route('contact.index')->with('message', 'Login successful');
        } else {
            // Jika pengguna gagal masuk, arahkan kembali ke halaman login dengan pesan kesalahan
            return redirect()->route('login.show')->with('error', 'Invalid credentials');
        }
    }

    public function logout()
    {
        Auth::logout(); // Keluarkan pengguna
        return redirect()->route('login.show')->with('message', 'Logged out successfully');
    }
}
