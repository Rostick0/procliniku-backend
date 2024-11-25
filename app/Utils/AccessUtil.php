<?php

namespace App\Utils;

use Illuminate\Database\Eloquent\builder;
use Illuminate\Http\JsonResponse;

class AccessUtil
{
    public static function cannot(string $method, $model): bool
    {
        return !auth()->check() || auth()->user()->cannot($method, $model);
    }

    public static function errorMessage($message = 'No access', $code = 403): JsonResponse
    {
        return new JsonResponse([
            'message' => $message
        ],  $code);
    }
}
