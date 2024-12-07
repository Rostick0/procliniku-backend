<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clinic>
 */
class ClinicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'rating' => fake()->randomFloat(1, 5),
            'link' => fake()->url(),
            'link_name' => strtolower(fake()->name()),
            'longitude' => fake()->longitude(),
            'latitude' => fake()->latitude(),
            'description' => fake()->text(random_int(100, 300)),
            'owner_id' => User::first()->id,
        ];
    }
}
