<?php
namespace App\Services;

use App\Models\Testimonial;

class TestimonialService
{
    public function list($perPage = 10)
    {
        return Testimonial::latest()->paginate($perPage);
    }

    public function store(array $data): Testimonial
    {
        $data['is_show'] = $data['is_show'] ?? false;
        return Testimonial::create($data);
    }

    public function update(Testimonial $testimonial, array $data): Testimonial
    {
        $data['is_show'] = $data['is_show'] ?? false;
        $testimonial->update($data);
        return $testimonial;
    }

    public function delete(Testimonial $testimonial): bool
    {
        return $testimonial->delete();
    }
}
