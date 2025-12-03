<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Depan
Route::get('/', function () {
    return view('welcome');
});

// --- ROUTE UNTUK TAMU (Belum Login) ---
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// --- ROUTE UNTUK MEMBER (Sudah Login) ---
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // 1. Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // 2. Route Simpan Data (Create)
    Route::post('/workout/store', [DashboardController::class, 'storeWorkout'])->name('workout.store');
    Route::post('/nutrition/store', [DashboardController::class, 'storeNutrition'])->name('nutrition.store');
    Route::post('/progress/store', [DashboardController::class, 'storeProgress'])->name('progress.store');
    
    // 3. Route Hapus Data (Delete)
    // Kita pakai parameter {type} dan {id} agar dinamis
    Route::delete('/delete/{type}/{id}', [DashboardController::class, 'destroyEntity'])->name('entity.destroy');
    
    // 4. Route Update Profile (Put)
    Route::put('/profile/update', [DashboardController::class, 'updateProfile'])->name('profile.update');
});