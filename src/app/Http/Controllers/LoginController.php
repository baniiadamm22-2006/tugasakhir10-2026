<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // 1. Validasi input email dan password wajib diisi
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Cek apakah email dan password COCOK dengan data di database
        if (Auth::attempt($credentials)) {
            // Jika cocok, buatkan session baru demi keamanan
            $request->session()->regenerate();
            
            // Arahkan masuk ke dashboard halaman utama
            return redirect()->intended('/');
        }

        // 3. Jika salah/tidak terdaftar, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }

    public function googleLogin(Request $request)
    {
        // Catatan: Jika fitur Google Login ini masih dicoba (bypass), biarkan seperti ini.
        // Tapi jika ingin digunakan secara nyata, nanti harus dihubungkan dengan Laravel Socialite.
        \Illuminate\Support\Facades\Auth::loginUsingId(1);
        
        $request->session()->regenerate();
        
        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}