<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FaqFactory extends Factory
{
    protected $model = \App\Models\Faq::class;

    public function definition()
    {
        return [
            'question' => $this->faker->sentence(6),
            'short_answer' => $this->faker->optional()->sentence(),
            'long_answer' => $this->faker->optional()->paragraphs(2, true),
            'is_show' => $this->faker->boolean(90),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
