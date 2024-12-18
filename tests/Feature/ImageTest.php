<?php

namespace Tests\Feature;

use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Tests\UserTestUtil;

class ImageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_image_create(): void
    {
        $name_image = 'test.png';
        $image = UploadedFile::fake()->image($name_image, 24, 24);
        [$user, $token] = UserTestUtil::getUserAndToken();

        $response = $this->post('/api/images', ['image' => $image], ['authorization' => 'Bearer ' . $token]);

        $response->assertStatus(201);

        $image_db = Image::firstWhere('name', $name_image);
        $response->assertJsonStructure([
            'data' => array_keys($image_db->getAttributes())
        ]);

        $this->assertDatabaseHas(Image::class, ['name' => $name_image]);

        $name_jpeg = str_replace(config()->get('app.url') . '/storage-custom', 'public', $image_db->path);
        $name_webp = str_replace('.jpeg', '.webp', $name_jpeg);

        Storage::assertExists([$name_jpeg, $name_webp]);
    }
}
