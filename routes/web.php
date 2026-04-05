<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/portfolio', function () {
    return Inertia::render('Portfolio');
});

Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name'    => 'required|string|max:120',
        'email'   => 'required|email|max:160',
        'phone'   => 'nullable|string|max:40',
        'message' => 'required|string|max:5000',
    ]);

    // Log or email the message here as needed
    \Illuminate\Support\Facades\Log::info('Contact form submission', $validated);

    return response()->json(['success' => true]);
});
