<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use App\Mail\ContactMessageReceived;
use App\Mail\ServiceInquiryReceived;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/portfolio', function () {
    return Inertia::render('Portfolio');
});

Route::get('/services', function () {
    return Inertia::render('Services');
});

Route::post('/service-inquiry', function (Request $request) {
    $validated = $request->validate([
        'service'  => 'required|string|max:160',
        'name'     => 'required|string|max:120',
        'email'    => 'required|email|max:160',
        'phone'    => 'nullable|string|max:40',
        'company'  => 'nullable|string|max:160',
        'budget'   => 'nullable|string|max:40',
        'timeline' => 'nullable|string|max:40',
        'details'  => 'required|string|max:5000',
    ]);

    $inquiry = \App\Models\ServiceInquiry::create($validated);

    try {
        Mail::to(config('mail.admin_notification_email'))
            ->send(new ServiceInquiryReceived($inquiry));
    } catch (\Throwable $e) {
        \Log::error('Service inquiry mail failed: ' . $e->getMessage());
    }

    return response()->json(['success' => true]);
});

Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name'    => 'required|string|max:120',
        'email'   => 'required|email|max:160',
        'phone'   => 'nullable|string|max:40',
        'message' => 'required|string|max:5000',
    ]);

    $contact = \App\Models\ContactMessage::create($validated);

    try {
        Mail::to(config('mail.admin_notification_email'))
            ->send(new ContactMessageReceived($contact));
    } catch (\Throwable $e) {
        \Log::error('Contact mail failed: ' . $e->getMessage());
    }

    return response()->json(['success' => true]);
});
