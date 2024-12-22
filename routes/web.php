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
Route::middleware(['auth'])->prefix('admin')->group(function () {
    // Dashboard route setelah login
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Posts Management
    Route::resource('posts', PostController::class)->names([
        'index' => 'admin.posts.index',
        'create' => 'admin.posts.create',
        'store' => 'admin.posts.store',
        'edit' => 'admin.posts.edit',
        'update' => 'admin.posts.update',
        'destroy' => 'admin.posts.destroy',
    ]);
    Route::delete('posts/bulk-delete', [PostController::class, 'bulkDelete'])->name('admin.posts.bulk-delete');
    Route::patch('posts/{post}/toggle-status', [PostController::class, 'toggleStatus'])->name('admin.posts.toggle-status');
    
    // Users Management
    Route::resource('users', AdminController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
    
    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings');
    Route::get('/settings/landing', [SettingController::class, 'landing'])->name('admin.settings.landing');
    Route::put('/settings/landing', [SettingController::class, 'landingUpdate'])->name('admin.settings.landing.update');
    Route::get('/settings/dashboard', [SettingController::class, 'dashboard'])->name('admin.settings.dashboard');
    Route::put('/settings/dashboard/update', [SettingController::class, 'dashboardUpdate'])->name('admin.settings.dashboard.update');
    Route::get('/admin/settings/seo', [SettingController::class, 'seo'])->name('admin.settings.seo');
    Route::put('/admin/settings/seo', [SettingController::class, 'seoUpdate'])->name('admin.settings.seo.update');
});

// Fallback Post Route
Route::get('/posts', [PostController::class, 'index'])->name('admin.posts');

Route::patch('posts/{post}/toggle-status', [PostController::class, 'toggleStatus'])
        ->name('posts.toggle-status');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
