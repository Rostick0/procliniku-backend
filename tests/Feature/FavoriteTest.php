<?php

namespace Tests\Feature;

use App\Models\Clinic;
use App\Models\Favorite;
use Database\Factories\FavoriteFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\UserTestUtil;

class FavoriteTest extends TestCase
{
    /**
     * use index method in FavoriteController.
     */
    public function test_get_favorites(): void
    {
        [$user, $token] = UserTestUtil::getUserAndToken();
        Favorite::factory(1, ['user_id' => $user->id])->create();

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
            'data' => []
        ]);
    }

    public function test_create_favorite(): void
    {
        [$user, $token] = UserTestUtil::getUserAndToken();

        $data_create = (new FavoriteFactory())->definition();

        $response = $this->post('/api/favorites', $data_create, ['authorization' => 'Bearer ' . $token]);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'data' => array_keys(Favorite::first()->getAttributes())
        ]);

        $this->assertDatabaseHas(Favorite::class, [...$data_create, 'user_id' => $user->id]);
    }

    public function test_delete_favorite(): void
    {
        [$user, $token] = UserTestUtil::getUserAndToken();

        $data_finded = Favorite::inRandomOrder()->first();

        $response = $this->delete('/api/favorites/' . $data_finded->clinic_id, [], ['authorization' => 'Bearer ' . $token]);

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'message'
        ]);

        $this->assertDatabaseMissing(Favorite::class, ['id' => $data_finded->id]);
    }
}
