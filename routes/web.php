<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

// Halaman Depan
Route::get('/', function () {
    return view('welcome');
});

// --- MENU UNTUK TAMU (Belum Login) ---
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register (Pastikan baris ini ada!)
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// --- MENU UNTUK MEMBER (Sudah Login) ---
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Update Profile
    Route::put('/profile/update', [DashboardController::class, 'updateProfile'])->name('profile.update');
});

// ... kode lainnya ...
Route::middleware('auth')->group(function () {
    // Route ini yang dipanggil tombol logout
    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::put('/profile/update', [App\Http\Controllers\DashboardController::class, 'updateProfile'])->name('profile.update');
});