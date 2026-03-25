<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    protected $model = \App\Models\Testimonial::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'designation' => $this->faker->jobTitle(),
            'content' => $this->faker->sentences(3, true),
            'description' => $this->faker->optional()->paragraph(),
            'main_image' => $this->faker->optional()->imageUrl(400, 400),
            'is_show' => $this->faker->boolean(85),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
