<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    // =====================================
    // 1. DANH SÁCH TIN NHẮN
    // =====================================
    public function index()
    {
        $contacts = Contact::latest()->paginate(10);

        return view('admin.contacts.index', compact('contacts'));
    }

    // =====================================
    // 2. XEM CHI TIẾT TIN NHẮN
    // =====================================
    public function show(Contact $contact)
    {
        return view('admin.contacts.show', compact('contact'));
    }

    // =====================================
    // 3. XÓA TIN NHẮN
    // =====================================
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'Xóa tin nhắn thành công!');
    }
}
