<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\OAuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (Auth::check() && request()->query('public') !== 'true') {
        return redirect()->route('admin.index');
    }

    return view('pages.blog');
})->name('home');

/*
|--------------------------------------------------------------------------
| GUEST ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::get('/auth/{provider}/callback', [OAuthController::class, 'handleProviderCallback'])
        ->name('auth.callback');
});

/*
|--------------------------------------------------------------------------
| OAUTH REDIRECT
|--------------------------------------------------------------------------
*/

Route::get('/auth/{provider}/redirect', [OAuthController::class, 'redirectToProvider'])
    ->name('auth.redirect');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    | Logout
    */
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {

            /*
            | Dashboard
            */
            Route::get('/', function () {
                return view('admin.index');
            })->name('index');

            /*
            | Articles Page
            */
            Route::get('/articles', function () {
                return view('admin.articles.articles');
            })->name('articles.index');

        });
});