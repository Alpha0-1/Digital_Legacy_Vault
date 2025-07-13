<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VaultController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\LegacyItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InactivityController;

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/verify-email', [EmailVerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationController::class, 'resend'])->name('verification.send');

Route::get('/two-factor', [TwoFactorController::class, 'showTwoFactorForm'])->name('two-factor');
Route::post('/two-factor', [TwoFactorController::class, 'enableTwoFactor']);

// Protected Routes
Route::middleware(['auth', 'email.verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/vault', [VaultController::class, 'index'])->name('vault.index');
    Route::get('/vault/create', [VaultController::class, 'create'])->name('vault.create');
    Route::post('/vault', [VaultController::class, 'store'])->name('vault.store');
    Route::get('/vault/{vault}', [VaultController::class, 'show'])->name('vault.show');
    Route::get('/vault/{vault}/edit', [VaultController::class, 'edit'])->name('vault.edit');
    Route::put('/vault/{vault}', [VaultController::class, 'update'])->name('vault.update');
    
    Route::resource('beneficiaries', BeneficiaryController::class);
    Route::resource('legacy-items', LegacyItemController::class);
    
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::resource('inactivity', InactivityController::class)->only(['edit', 'update']);
});

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('users', Admin\UserController::class);
        Route::resource('system', Admin\SystemController::class);
    });
});
