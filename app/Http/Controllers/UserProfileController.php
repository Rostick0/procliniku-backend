<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserProfile\UpdateUserProfileRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function update(UpdateUserProfileRequest $request)
    {
        $user = auth()->user();

        $user->update($request->validated());

        return new JsonResponse([
            'data' => $user
        ]);
    }

    public function updateEmail() {}
}
