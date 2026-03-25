<?php

namespace App\Services;

use App\Models\Service;

class ServicesService
{
    public function list($perPage = 10)
    {
        return Service::latest()->paginate($perPage);
    }

    public function store(array $data)
    {
        return Service::create($data);
    }

    public function update(Service $service, array $data)
    {
        $service->update($data);
        return $service;
    }

    public function delete(Service $service)
    {
        return $service->delete();
    }
}
