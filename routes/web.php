<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/index', function () {
    return view('index');
});
Route::get('/dashboard', function () {
    return view('layout.dashboard');
});
Route::get('/suratmasuk', function () {
    return view('layout.suratmasuk');
});
Route::get('/tambahsuratmasuk', function () {
    return view('layout.tambahsuratmasuk');
});
