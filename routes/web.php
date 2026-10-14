<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/home', function () {
    return view('mahasiswa.home');
})->middleware('auth')->name('home');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

