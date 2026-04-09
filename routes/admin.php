<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

// Guest-only routes (redirect to dashboard if already authenticated)
Route::middleware('admin.guest')->group(function () {
    Route::get('/ajayupadhyay-secure-login', [AuthController::class, 'showLogin'])
        ->name('admin.login');

    Route::post('/ajayupadhyay-secure-login', [AuthController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('admin.login.submit');
});

// Authenticated admin routes
Route::middleware('admin.auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('admin.logout');
});
