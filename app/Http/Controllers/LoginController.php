<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Memproses data login
    public function login(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cek fitur 'Remember Me'
        $remember = $request->has('remember');

        // 2. Coba Autentikasi (Laravel otomatis mengecek hash password)
        if (Auth::attempt($credentials, $remember)) {
            // Regenerasi session untuk keamanan (mencegah session fixation)
            $request->session()->regenerate();

            // Redirect ke halaman admin jika sukses (atau halaman utama)
            return redirect()->intended(route('admin.index'));
        }

        // 3. Jika Gagal, kembalikan error ke input email
        throw ValidationException::withMessages([
            'email' => 'Kredensial yang Anda masukkan tidak cocok dengan data kami.',
        ]);
    }

    // Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();

        // Hancurkan session saat ini
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Kembalikan ke halaman utama blog
        return redirect('/');
    }
}
