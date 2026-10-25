<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('laporan.index');
});


Route::get('/laporan/buat', [LaporanController::class, 'create'])->name('laporan.create');
Route::post('/laporan/simpan', [LaporanController::class, 'store'])->name('laporan.store');


Route::get('/form', [DataController::class, 'form']);
Route::post('/proses', [DataController::class, 'proses']);


Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

  
    Route::get('/profil', [LoginController::class, 'profile'])->name('petugas.profile');
    Route::get('/profile', [LoginController::class, 'profile']);

    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
