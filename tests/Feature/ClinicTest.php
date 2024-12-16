<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Clinic;
use App\Models\Region;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClinicTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_clinics(): void
    {
        $response = $this->get('/api/clinics');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                array_keys(Clinic::first()->getAttributes())
            ]
        ]);
    }
}
