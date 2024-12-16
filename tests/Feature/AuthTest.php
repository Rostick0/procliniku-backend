<?php

namespace Tests\Feature;

use App\Enum\EmailCodeType;
use App\Http\Controllers\AuthController;
use App\Models\EmailCode;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public static array $user_data = [
        'email' => 'test@email.com',
        'password' => '@432rfvc',
        'name' => 'test',
    ];
    /**
     * A basic feature test example.
     */

    public function test_auth_register(): void
    {
        $code = sprintf('%06d', rand(1, 1000000));

        EmailCode::create([
            'email' => self::$user_data['email'],
            'code' => $code,
            'type' => EmailCodeType::register->value,
        ]);

        $response = $this->post('/api/auth/register', [...self::$user_data, 'code' => $code]);

        $response->assertStatus(201);

        $this->assertDatabaseHas(User::class, ['email' => self::$user_data['email']]);
    }

    public function test_auth_login(): void
    {
        User::create(self::$user_data);

        $response = $this->post('/api/auth/login', self::$user_data);
        $response->assertStatus(201);
        $response->assertJsonStructure(['data' => [
            'access_token',
            'token_type',
            'expires_in',
            'user',
        ]]);
    }

    public function test_auth_me(): void
    {
        User::create(self::$user_data);

        $token = JWTAuth::attempt(self::$user_data);

        $response = $this->get('/api/auth/me', ['authorization' => 'Bearer ' . $token]);
        $response->assertStatus(200);

        $response->assertJsonStructure(['data']);
    }
}
