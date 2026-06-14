<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\OAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ==========================================
// PUBLIC ROUTES
// ==========================================
Route::get('/', function () {
    // Jika admin sudah login, saat refresh / buka halaman ini akan otomatis ke /admin
    if (Auth::check() && request()->query('public') !== 'true') {
        return redirect()->route('admin.index');
    }

    return view('pages.blog');
});

// ==========================================
// GUEST ROUTES (Hanya untuk yang BELUM Login)
// ==========================================
Route::middleware('guest')->group(function () {
    // Form Login Page
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

    // Callback OAuth
    Route::get('auth/{provider}/callback', [OAuthController::class, 'handleProviderCallback'])->name('auth.callback');
});

// ==========================================
// STATELESS OAUTH ENDPOINTS (Dipanggil via Fetch JS)
// ==========================================
Route::get('auth/{provider}/redirect', [OAuthController::class, 'redirectToProvider'])->name('auth.redirect');

// ==========================================
// AUTH ROUTES (Khusus yang SUDAH Login)
// ==========================================
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Admin Panel Area
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('index');

        Route::get('/articles', function () {
            return view('admin.articles.home');
        })->name('articles.index');
    });
});

// ==========================================
// FALLBACKS / UTILITIES
// ==========================================
Route::get('/forgot-password', function () {
    return 'Halaman Lupa Password';
})->name('password.request');
