<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = User::class;

    public function definition(): array
    {
        $clientIds = User::role(config('site.roles.client'))->pluck('id')->push(null);

        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'client_id' => $clientIds->random(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'Password@123#',
            'mobile_no' => fake()->numberBetween(1000000000, 9999999999),
            'address' => 'created-from-factory',
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            return $user->assignRole(config('site.roles.user'));
        });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
