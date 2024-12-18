<?php

namespace Tests;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserTestUtil
{
    public static function getUserAndToken()
    {
        $user = User::first();

        return [$user, self::getToken($user)];
    }

    public static function getToken(?User $user = null)
    {
        return JWTAuth::fromUser($user ?? User::first());
    }
}
