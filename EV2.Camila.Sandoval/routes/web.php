<?php

use Illuminate\Support\Facades\Route;

// Redirigir raíz al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Vista de inicio de sesión
Route::get('/login', function () {
    return view('login');
})->name('login');

// Vista de registro
Route::get('/register', function () {
    return view('register');
})->name('register');
