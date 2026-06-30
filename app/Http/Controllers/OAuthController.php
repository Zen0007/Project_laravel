<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\AbstractProvider;

class OAuthController extends Controller
{
    public function redirectToProvider(string $provider): JsonResponse
    {
        if (! in_array($provider, ['github', 'google'])) {
            return response()->json(['error' => 'Provider not supported'], 400);
        }

        try {
            /** @var AbstractProvider $driver */
            $driver = Socialite::driver($provider);

            // Ambil URL target redirect Google/GitHub
            $url = $driver->stateless()->redirect()->getTargetUrl();

            return response()->json(['url' => $url]);
        } catch (\Exception $e) {
            // Jika driver Google error / salah konfigurasi, kirim JSON 500 agar JS tidak crash
            return response()->json([
                'success' => false,
                'message' => 'Socialite Driver Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function handleProviderCallback(string $provider)
    {
        if (! in_array($provider, ['github', 'google'])) {
            return redirect()->route('login')->with('error', 'Provider tidak didukung.');
        }

        try {
            /** @var AbstractProvider $driver */
            $driver = Socialite::driver($provider);

            // Sekarang teks editor tahu bahwa method 'stateless' itu ada
            $socialUser = $driver->stateless()->user();

            // Cari user berdasarkan email, atau buat baru jika belum terdaftar
            $user = User::updateOrCreate([
                'email' => $socialUser->getEmail(),
            ], [
                'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User ' . Str::random(5),
                // Karena login lewat OAuth, password kita isi dengan string acak yang aman
                'password' => Hash::make(Str::random(24)),
                'email_verified_at' => now(),
            ]);

            // Daftarkan session login ke sistem Laravel
            Auth::login($user, true);

            // Redirect sukses ke halaman utama admin kamu
            return redirect()->route('admin.index');
        } catch (\Exception $e) {
            // Jika ada error (misal token expired atau koneksi gagal), kembalikan ke login dengan pesan error
            return redirect()->route('login')->with('error', 'Autentikasi gagal: ' . $e->getMessage());
        }
    }
}
