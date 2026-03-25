<?php

namespace App\Services;

use App\Models\Contact;

class ContactService
{
    public function list($perPage = 10)
    {
        // return Contact::latest()->paginate($perPage);
        return Contact::latest()->first();
    }
    
    public function update(Contact $contact, array $data)
    {
        $contact->update($data);
        return $contact;
    }
}
