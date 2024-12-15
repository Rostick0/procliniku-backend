<?php

namespace Database\Factories;

use App\Models\Clinic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $clinic = Clinic::inRandomOrder()->first();

        return [
            'price' => fake()->randomFloat(2, 500, 10000),
            'date' => fake()->dateTimeBetween('-1 week', '3 weeks'),
            'service_id' => $clinic->clinic_services()->inRandomOrder()->first()->service_id,
            'clinic_id' => $clinic->id,
            'user_id' => User::first()->id,
        ];
    }
}
