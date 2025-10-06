<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPegawaiController;

// Halaman awal → redirect ke login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//dashboard pegawai
Route::get('/dashboardpegawai', [DashboardController::class, 'index']);

// Dashboard (bisa dikasih middleware kalau mau)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
