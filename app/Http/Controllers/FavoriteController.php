<?php

namespace App\Http\Controllers;

use App\Http\Requests\Favorite\StoreFavoriteRequest;
use App\Models\Favorite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Rostislav\LaravelFilters\Filter;

class FavoriteController extends Controller
{
    protected static function getWhere(Request $request = null)
    {
        $where = [];

        if ($request->user()?->role !== 'admin') {
            $where[] = ['user_id', '=', auth()?->id()];
        }

        return $where;
    }

    public function index(Request $request)
    {
        return new JsonResponse(
            Filter::all($request, new Favorite(), [], $this::getWhere($request))
        );
    }

    public function store(StoreFavoriteRequest $request)
    {
        $favorite = Favorite::firstOrCreate([
            ...$request->validated(),
            'user_id' => $request->user()->id
        ]);

        return new JsonResponse([
            'data' => $favorite
        ], 201);
    }

    public function destroy(Request $request, int $clinic_id)
    {
        Favorite::where([
            'clinic_id' => $clinic_id,
            'user_id' => $request->user()->id
        ])->delete();

        return new JsonResponse([
            'message' => 'Deleted'
        ]);
    }
}
