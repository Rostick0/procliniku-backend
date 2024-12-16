<?php

namespace Tests\Feature;

use App\Models\Service;
use Database\Seeders\ServiceCategorySeeder;
use Database\Seeders\ServiceTypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_services(): void
    {
        $response = $this->get('/api/services');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                array_keys(Service::first()->getAttributes())
            ]
        ]);
    }
}
