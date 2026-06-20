<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\OAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    // Jika sudah login dan tidak meminta halaman publik
    if (Auth::check() && request()->query('public') !== 'true') {
        return redirect()->route('admin.index');
    }

    return view('pages.blog');
})->name('home');

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // Login Page
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    // OAuth Callback
    Route::get('/auth/{provider}/callback', [OAuthController::class, 'handleProviderCallback'])
        ->name('auth.callback');
});

/*
|--------------------------------------------------------------------------
| OAuth Redirect
|--------------------------------------------------------------------------
*/

Route::get('/auth/{provider}/redirect', [OAuthController::class, 'redirectToProvider'])
    ->name('auth.redirect');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Admin Area
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {

            // Dashboard / Home
            Route::get('/', function () {
                return view('admin.index');
            })->name('index');

            // Articles List
            Route::get('/articles', function () {
                return view('admin.index');
            })->name('articles.index');

            // Create Article
            // Route::get('/articles/create', function () {
            //     return view('admin.articles.create');
            // })->name('articles.create');

            // // Edit Article
            // Route::get('/articles/{id}/edit', function ($id) {
            //     return view('admin.articles.edit', compact('id'));
            // })->name('articles.edit');
        });
});

/*
|--------------------------------------------------------------------------
| Utility Pages
|--------------------------------------------------------------------------
*/

// Route::get('/forgot-password', function () {
//     return view('auth.forgot-password');
// })->name('password.request');
