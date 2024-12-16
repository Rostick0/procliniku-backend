<?php

namespace Tests\Feature;

use App\Models\Favorite;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class FavoriteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_favorites(): void
    {
        $user = User::first();
        $token = JWTAuth::fromUser($user);
        Favorite::factory()->create();

        $response = $this->get('/api/favorites',  ['authorization' => 'Bearer ' . $token]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                array_keys(Favorite::first()->getAttributes())
            ]
        ]);
    }

    public function test_get_favorites_empty()
    {
        $response = $this->get('/api/favorites');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                array_keys(Favorite::first()->getAttributes())
            ]
        ]);
    }

    public function test_create_favorite(): void
    {
        $user = User::first();
        $token = JWTAuth::fromUser($user);
        Favorite::factory()->create();

        $response = $this->post('/api/favorites', [], ['authorization' => 'Bearer ' . $token]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                array_keys(Favorite::first()->getAttributes())
            ]
        ]);
    }
}
