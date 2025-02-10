<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ApiCacheController extends ApiController
{
    protected $expiration_index = 3600;
    protected $expiration_one = 3600;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index(Request $request)
    {
        if ($request->without_cache) return parent::index($request);

        $key = $this->model->getTable() . '.' . $request->getQueryString();
        if (Cache::has($key)) {
            return response(
                Cache::get($key),
                200,
                ['Content-Type' => 'application/json; charset=UTF-8']
            );
        }
        $data = parent::index($request);

        Cache::set($key, $data->getContent(), $this->expiration_index);

        return $data;
    }

    public function show(Request $request, int $id)
    {
        if ($request->without_cache) return parent::show($request, $id);

        $key = $this->model->getTable() . '.' . $id . '.' . $request->getQueryString();
        if (Cache::has($key)) {
            return response(
                Cache::get($key),
                200,
                ['Content-Type' => 'application/json; charset=UTF-8']
            );
        }

        $data = parent::show($request, $id);

        Cache::set($key, $data->getContent(), $this->expiration_one);

        return $data;
    }
}
