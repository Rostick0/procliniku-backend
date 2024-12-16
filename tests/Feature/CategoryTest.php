<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/api/categories');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                array_keys(Category::first()->getAttributes())
            ]
        ]);
    }
}
