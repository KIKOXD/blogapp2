<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;

// Landing Page untuk Customer
Route::get('/', function () {
    return view('customer.index');
})->name('home');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes (Proteksi Auth)
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');

    // Menu Postingan
    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('admin.posts.index');
        Route::get('/create', [PostController::class, 'create'])->name('admin.posts.create');
        Route::post('/', [PostController::class, 'store'])->name('admin.posts.store');
        Route::get('/{id}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
        Route::put('/{id}', [PostController::class, 'update'])->name('admin.posts.update');
        Route::delete('/{id}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
    });
});
