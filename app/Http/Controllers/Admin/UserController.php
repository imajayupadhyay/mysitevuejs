<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Users', [
            'admins'         => Admin::latest()->get(['id', 'name', 'email', 'created_at']),
            'currentAdminId' => auth('admin')->id(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:120',
            'email'                 => 'required|email|max:160|unique:admins,email',
            'password'              => 'required|string|min:8|confirmed',
        ]);

        Admin::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        return back()->with('success', 'Admin created successfully.');
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name'  => 'required|string|max:120',
            'email' => 'required|email|max:160|unique:admins,email,' . $admin->id,
        ]);

        $admin->update($request->only('name', 'email'));

        return back()->with('success', 'Details updated successfully.');
    }

    public function updatePassword(Request $request, Admin $admin)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin->update(['password' => $request->password]);

        return back()->with('success', 'Password updated successfully.');
    }

    public function destroy(Admin $admin)
    {
        if ($admin->id === auth('admin')->id()) {
            return back()->withErrors(['delete' => 'You cannot delete your own account.']);
        }

        $admin->delete();

        return back()->with('success', 'Admin deleted successfully.');
    }
}
