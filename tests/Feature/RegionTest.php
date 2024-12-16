<?php

namespace Tests\Feature;

use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_regions(): void
    {
        $response = $this->get('/api/regions');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                array_keys(Region::first()->getAttributes())
            ]
        ]);
    }

    public function test_get_region(): void
    {
        $region = Region::first();

        $response = $this->get('/api/regions/' . $region->id);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => array_keys($region->getAttributes())
        ]);
    }
}
