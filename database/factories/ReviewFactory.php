<?php

namespace Database\Factories;

use App\Models\Clinic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rating' => random_int(1, 5),
            'text' => fake()->text(random_int(200, 255)),
            'clinic_id' => Clinic::inRandomOrder()->first()?->id,
            'user_id' => User::first()?->id,
        ];
    }
}
