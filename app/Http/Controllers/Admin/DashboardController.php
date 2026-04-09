<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $admin = auth('admin')->user();

        return Inertia::render('Admin/Dashboard', [
            'admin' => [
                'name'  => $admin->name,
                'email' => $admin->email,
            ],
        ]);
    }
}
