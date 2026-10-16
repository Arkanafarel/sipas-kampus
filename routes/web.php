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
Route::get('/pengaduan/create', function () {
    $categories = Category::all();

    return view('mahasiswa.pengaduan', compact('categories'));
})->middleware('auth')->name('pengaduan.create');

Route::post('/pengaduan', [ComplaintController::class, 'store'])->middleware('auth')->name('pengaduan.store');

Route::get('/pengaduan', [ComplaintController::class, 'index'])->middleware('auth')->name('pengaduan.index');
Route::get('/pengaduan/{id}', [ComplaintController::class, 'show'])->middleware('auth')->name('pengaduan.show');
Route::get('/pengaduan/{id}/edit', [ComplaintController::class, 'edit'])->middleware('auth')->name('pengaduan.edit');
Route::put('/pengaduan/{id}', [ComplaintController::class, 'update'])->middleware('auth')->name('pengaduan.update');
Route::delete('/pengaduan/{id}', [ComplaintController::class, 'destroy'])->middleware('auth')->name('pengaduan.destroy');
