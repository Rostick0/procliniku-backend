<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CityTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_cities(): void
    {
        $response = $this->get('/api/cities');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                array_keys(City::first()->getAttributes())
            ]
        ]);
    }

    public function test_get_city(): void
    {
        $city = City::first();

        $response = $this->get('/api/cities/' . $city->id);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => array_keys($city->getAttributes())
        ]);
    }
}
