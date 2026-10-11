<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $status = $request->query('status', 'all');

        if (!in_array($status, ['all', 'read', 'unread'], true)) {
            $status = 'all';
        }

        $query = Contact::query();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('subject', 'like', '%' . $search . '%')
                  ->orWhere('message', 'like', '%' . $search . '%');
            });
        }

        if ($status === 'read') {
            $query->where('is_read', true);
        }

        if ($status === 'unread') {
            $query->where('is_read', false);
        }

        $contacts = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalContacts = Contact::count();
        $unreadContacts = Contact::where('is_read', false)->count();
        $readContacts = Contact::where('is_read', true)->count();

        return view('admin.contacts.index', compact(
            'contacts',
            'search',
            'status',
            'totalContacts',
            'unreadContacts',
            'readContacts'
        ));
    }

    public function show(Contact $contact)
    {
        if (!$contact->is_read) {
            $contact->is_read = true;
            $contact->save();
        }

        return view('admin.contacts.show', compact('contact'));
    }

    public function markUnread(Contact $contact)
    {
        $contact->is_read = false;
        $contact->save();

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'Đã đánh dấu tin nhắn chưa đọc.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'Đã xóa tin nhắn thành công!');
    }
}
