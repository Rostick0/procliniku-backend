<?php

namespace Tests\Feature;

use App\Models\ServiceType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceTypeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_service_types(): void
    {
        $response = $this->get('/api/services');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                array_keys(ServiceType::first()->getAttributes())
            ]
        ]);
        $response->assertStatus(200);
    }
}
