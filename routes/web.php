<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;


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
    $complaints = \App\Models\Complaint::where('user_id', auth()->id())
        ->latest()
        ->take(5)
        ->get();

    return view('mahasiswa.home', compact('complaints'));
})->middleware('auth')->name('home');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::post('/pengaduan', [ComplaintController::class, 'store'])->middleware('auth')->name('pengaduan.store');

Route::get('/pengaduan/create', function () {
    $categories = Category::all();

    return view('mahasiswa.pengaduan', compact('categories'));
})->middleware('auth')->name('pengaduan.create');