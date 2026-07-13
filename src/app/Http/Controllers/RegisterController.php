<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    // Menampilkan halaman pendaftaran
    public function showRegister()
    {
        return view('register');
    }

    // Proses menyimpan data ke Database
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Membuat user baru di database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password di-hash agar aman
        ]);

        // Login otomatis setelah daftar
        Auth::login($user);

        return redirect('/')->with('success', 'Akun berhasil dibuat dan Anda telah login!');
    }
}