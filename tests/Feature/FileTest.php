<?php

namespace Tests\Feature;

use App\Models\File;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Tests\UserTestUtil;

class FileTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_file_create(): void
    {
        $name_file = 'test.txt';
        $file = UploadedFile::fake()->create($name_file, fake()->text(), 'text/plain');
        [$user, $token] = UserTestUtil::getUserAndToken();

        $response = $this->post('/api/files', ['file' => $file], ['authorization' => 'Bearer ' . $token]);

        $response->assertStatus(201);

        $file_db = File::firstWhere('name', $name_file);
        $response->assertJsonStructure([
            'data' => array_keys($file_db->getAttributes())
        ]);

        $this->assertDatabaseHas(File::class, ['name' => $name_file]);

        $file_path = str_replace(config()->get('app.url') . '/storage', 'public', $file_db->path);

        Storage::assertExists($file_path);
    }
}
