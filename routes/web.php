<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('placeholder');
});

Route::get("/home",function () {
    return view('welcome');
});