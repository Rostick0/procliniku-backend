<?php

namespace Tests\Feature;

use App\Models\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppointmentTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_appointments(): void
    {
        $response = $this->get('/api/appointments');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                array_keys(Appointment::first()->getAttributes())
            ]
        ]);
    }

    public function test_get_appointment(): void
    {
        $appointment = Appointment::first();

        $response = $this->get('/api/appointments/' . $appointment->id);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => array_keys($appointment->getAttributes())
        ]);
    }
}
