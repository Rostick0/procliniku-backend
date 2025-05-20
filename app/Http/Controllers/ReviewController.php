<?php

namespace App\Http\Controllers;

use App\Http\Requests\Review\StoreOrUpdateReviewRequest;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReviewController extends ApiController
{
    public function __construct()
    {
        $this->model = new Review;
        $this->is_auth_id = true;
    }

    public function storeOrUpdate(StoreOrUpdateReviewRequest $request)
    {
        $review = Review::updateOrCreate([
            'user_id' => auth()->id(),
            'clinic_id' => $request->clinic_id,
        ], $request->only(['rating', 'text']));

        return new JsonResponse([
            'data' => $review
        ]);
    }
}
