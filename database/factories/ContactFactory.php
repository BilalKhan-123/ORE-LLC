<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = \App\Models\Contact::class;

    public function definition()
    {
        return [
            'address' => $this->faker->address(),
            'phone_1' => $this->faker->phoneNumber(),
            'phone_2' => $this->faker->optional()->phoneNumber(),
            'phone_3' => $this->faker->optional()->phoneNumber(),
            'email_1' => $this->faker->optional()->safeEmail(),
            'email_2' => $this->faker->optional()->safeEmail(),
            'email_3' => $this->faker->optional()->safeEmail(),
            'map' => '<iframe src="https://maps.example.com/embed"></iframe>',
            'description' => $this->faker->optional()->paragraph(),
            'main_image' => $this->faker->optional()->imageUrl(1200, 600),
            'is_show' => $this->faker->boolean(90),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
