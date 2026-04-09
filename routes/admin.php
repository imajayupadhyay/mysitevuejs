<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
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

    // Contacts
    Route::get('/contacts', [ContactController::class, 'index'])
        ->name('admin.contacts.index');

    Route::patch('/contacts/{contact}/toggle-read', [ContactController::class, 'toggleRead'])
        ->name('admin.contacts.toggle-read');

    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])
        ->name('admin.contacts.destroy');

    // Users (admin management)
    Route::get('/users', [UserController::class, 'index'])
        ->name('admin.users.index');

    Route::post('/users', [UserController::class, 'store'])
        ->name('admin.users.store');

    Route::put('/users/{admin}', [UserController::class, 'update'])
        ->name('admin.users.update');

    Route::patch('/users/{admin}/password', [UserController::class, 'updatePassword'])
        ->name('admin.users.password');

    Route::delete('/users/{admin}', [UserController::class, 'destroy'])
        ->name('admin.users.destroy');
});
