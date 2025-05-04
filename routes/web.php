<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Toko;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/beranda', [Toko::class, 'beranda']);