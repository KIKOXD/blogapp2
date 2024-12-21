<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Define all routes for your application here.
*/

// Landing Page dan Customer Routes (Tanpa Auth)
Route::get('/', [CustomerController::class, 'index'])->name('home');
Route::get('/posts/{slug}', [CustomerController::class, 'show'])->name('posts.show');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Ini prefix kalau sudah login baru terbaca
Route::prefix('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin Routes (Proteksi Auth)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Posts Management
    Route::resource('posts', PostController::class);

    // Users Management
    Route::resource('users', AdminController::class);

    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
});

// Fallback Post Route
Route::get('/posts', [PostController::class, 'index'])->name('admin.posts');

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
//     // ... route lainnya
// });

