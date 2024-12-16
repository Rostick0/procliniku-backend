<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Clinic;
use App\Models\Region;
use App\Models\Review;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_reviews(): void
    {
        Review::factory()->create();

        $response = $this->get('/api/reviews');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                array_keys(Review::first()->getAttributes())
            ]
        ]);
    }
}
