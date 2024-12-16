<?php

namespace Tests\Feature;

use App\Models\ServiceCategory;
use Database\Seeders\ServiceCategorySeeder;
use Database\Seeders\ServiceTypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceCategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_service_categories(): void
    {
        $response = $this->get('/api/service-categories');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                array_keys(ServiceCategory::first()->getAttributes())
            ]
        ]);
    }
}
