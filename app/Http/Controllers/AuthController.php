<?php

namespace App\Http\Controllers;

use App\Enum\EmailCodeType;
use App\Http\Requests\Auth\LoginAuthRequest;
use App\Http\Requests\Auth\RegisterAuthRequest;
use App\Models\EmailCode;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Rostislav\LaravelFilters\Filter;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(LoginAuthRequest $request)
    {
        $validated = $request->validated();

        if (!$token = JWTAuth::attempt($validated)) return new JsonResponse(['message' => 'Неправильный логин или пароль'], 401);

        return $this::createNewToken($token);
    }

    public function register(RegisterAuthRequest $request)
    {
        User::create($request->validated());

        EmailCode::where([
            ['email', '=', $request->email],
            ['type', '=', EmailCodeType::register]
        ])->delete();

        $token = JWTAuth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        return $this::createNewToken($token);
    }

    public function logout()
    {
        auth()?->logout();
        return response()->json(['message' => 'Вы вышли из аккаунта']);
    }

    public function refresh()
    {
        return $this::createNewToken(auth()?->refresh());
    }

    public function me(Request $request)
    {
        return new JsonResponse([
            'data' => Filter::one($request, new User, auth()->id())
        ]);
    }

    public static function createNewToken($token)
    {
        return response()->json([
            'data' => [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()?->factory()->getTTL() * 60 * 24 * 7,
                'user' => auth()->user()
            ]
        ], 201);
    }
}
