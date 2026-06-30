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

        $remember = $request->has('remember');

        // 2. Coba Autentikasi
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // JIKA REQUEST MEMINTA JSON (Dari JS Fetch/Axios)
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'redirect' => redirect()->intended(route('admin.index'))->getTargetUrl()
                ]);
            }

            return redirect()->intended(route('admin.index'));
        }

        // 3. Jika Gagal dan request meminta JSON
        if ($request->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Kredensial yang Anda masukkan tidak cocok dengan data kami.'
            ], 422);
        }

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
