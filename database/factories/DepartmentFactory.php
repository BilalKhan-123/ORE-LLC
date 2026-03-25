<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    protected $model = \App\Models\Department::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'sub_title' => $this->faker->optional()->sentence(),
            'description' => $this->faker->optional()->paragraphs(3, true),
            'main_image' => $this->faker->optional()->imageUrl(1200, 600),
            'image' => $this->faker->optional()->imageUrl(800, 400),
            'logo' => $this->faker->optional()->imageUrl(200, 200),
            'is_show' => $this->faker->boolean(80),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
