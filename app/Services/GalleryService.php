<?php

namespace App\Services;

use App\Models\Galary;

class GalleryService
{
    public function list($perPage = 10)
    {
        return Galary::latest()->paginate($perPage);
    }

    public function store(array $data)
    {
        return Galary::create($data);
    }

    public function update(Galary $galary, array $data)
    {
        $galary->update($data);
        return $galary;
    }

    public function delete(Galary $galary)
    {
        return $galary->delete();
    }
}
