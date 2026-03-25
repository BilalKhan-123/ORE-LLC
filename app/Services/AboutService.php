<?php

namespace App\Services;

use App\Models\About;

class AboutService
{
    public function list($perPage = 10)
    {
        return About::latest()->first();
    }
    
    public function update(About $about, array $data)
    {
        $about->update($data);
        return $about;
    }
}
