<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Define all routes for your application here.
*/

// Landing & Auth Routes (No Auth Required)
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
    // Dashboard route setelah login
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Posts Management
    Route::resource('posts', PostController::class);
    Route::delete('posts/bulk-delete', [PostController::class, 'bulkDelete'])->name('posts.bulk-delete');
    Route::patch('posts/{post}/toggle-status', [PostController::class, 'toggleStatus'])->name('posts.toggle-status');
    
    // Users Management
    Route::resource('users', AdminController::class);
    
    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::get('/settings/landing', [SettingController::class, 'landing'])->name('settings.landing');
    Route::put('/settings/landing', [SettingController::class, 'updateLanding'])->name('settings.landing.update');
    Route::get('/settings/dashboard', [SettingController::class, 'dashboard'])->name('settings.dashboard');

    // // Bulk Actions
    // Route::delete('posts/bulk-delete', [PostController::class, 'bulkDelete'])->name('posts.bulk-delete');
    // Route::patch('posts/{post}/toggle-status', [PostController::class, 'toggleStatus'])->name('posts.toggle-status');

});

// Fallback Post Route
Route::get('/posts', [PostController::class, 'index'])->name('admin.posts');

Route::patch('posts/{post}/toggle-status', [PostController::class, 'toggleStatus'])
        ->name('posts.toggle-status');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
//     // Bulk actions
//     Route::delete('posts/bulk-delete', [PostController::class, 'bulkDelete'])->name('posts.bulk-delete');
// });

// Route::middleware(['auth'])->group(function () {
//     Route::prefix('admin')->name('admin.')->group(function () {
//         Route::patch('posts/bulk-activate', [PostController::class, 'bulkActivate'])->name('posts.bulk-activate');
//         Route::patch('posts/bulk-deactivate', [PostController::class, 'bulkDeactivate'])->name('posts.bulk-deactivate');
//         Route::delete('posts/bulk-delete', [PostController::class, 'bulkDelete'])->name('posts.bulk-delete');
//         Route::patch('posts/{post}/toggle-status', [PostController::class, 'toggleStatus'])->name('posts.toggle-status');
//     });
// });
