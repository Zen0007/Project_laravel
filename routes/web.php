<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('blog');
});

Route::get("/home",function () {
    return view('welcome');
});