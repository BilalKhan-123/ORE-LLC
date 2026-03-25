<?php

namespace App\Services;

use App\Models\UserContactMessage;

class UserContactMessageServices
{
    public function list($perPage = 10)
    {
        return UserContactMessage::latest()->paginate($perPage);
    }

    public function show($id)
    {
        return UserContactMessage::findOrFail($id);
    }

    public function store(array $data)
    {
        return UserContactMessage::create($data);
    }

    public function delete(UserContactMessage $userContactMessage)
    {
        return $userContactMessage->delete();
    }
    
}
