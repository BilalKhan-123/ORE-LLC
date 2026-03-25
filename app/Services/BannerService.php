<?php
namespace App\Services;

use App\Models\Banner;

class BannerService
{
    public function list($perPage = 10)
    {
        return Banner::latest()->paginate($perPage);
    }

    public function store(array $data): Banner
    {
        return Banner::create($data);
    }

    public function update(Banner $banner, array $data): Banner
    {
        $banner->update($data);
        return $banner;
    }

    public function delete(Banner $banner): bool
    {
        return $banner->delete();
    }
}
