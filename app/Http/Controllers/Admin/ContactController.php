<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = ContactMessage::query()
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($sub) use ($request) {
                    $sub->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('email', 'like', '%' . $request->search . '%')
                        ->orWhere('message', 'like', '%' . $request->search . '%');
                });
            })
            ->when($request->status === 'unread', fn ($q) => $q->whereNull('read_at'))
            ->when($request->status === 'read', fn ($q) => $q->whereNotNull('read_at'))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return Inertia::render('Admin/Contacts', [
            'contacts' => $contacts,
            'filters'  => $request->only(['search', 'status']),
            'stats'    => [
                'total'  => ContactMessage::count(),
                'unread' => ContactMessage::whereNull('read_at')->count(),
                'read'   => ContactMessage::whereNotNull('read_at')->count(),
            ],
        ]);
    }

    public function toggleRead(ContactMessage $contact)
    {
        $contact->update([
            'read_at' => $contact->read_at ? null : now(),
        ]);

        return back();
    }

    public function destroy(ContactMessage $contact)
    {
        $contact->delete();

        return back()->with('success', 'Message deleted.');
    }
}
