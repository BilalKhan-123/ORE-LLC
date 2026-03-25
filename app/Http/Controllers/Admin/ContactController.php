<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Services\ContactService;

class ContactController extends Controller
{
    public function __construct(
        protected ContactService $contactService
    ) {}

    public function index()
    {
        $contact = $this->contactService->list();
        return view('admin.contacts.index', compact('contact'));
    }
    
    public function edit(Contact $contact)
    {
        return view('admin.contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'phone_1' => 'required|string|max:255',
            'email_1' => 'required|string|max:255',
            'is_show' => 'required|in:0,1',
        ]);

        $data = $request->except('_token', '_method');

        $this->contactService->update($contact, $data);

        return redirect()
            ->route('admin.contacts.index')
            ->with('success', 'Record updated successfully.');
    }
}

