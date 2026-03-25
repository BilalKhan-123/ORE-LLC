<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GalaryFactory extends Factory
{
    protected $model = \App\Models\Galary::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'sub_title' => $this->faker->optional()->sentence(),
            'description' => $this->faker->optional()->paragraph(),
            'main_image' => $this->faker->optional()->imageUrl(1200, 800),
            'is_show' => $this->faker->boolean(80),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
