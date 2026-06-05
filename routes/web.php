<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('surat undangan');
});

Route::get("/home",function () {
    return view('welcome');
});