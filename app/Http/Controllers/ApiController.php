<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\AccessUtil;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Rostislav\LaravelFilters\Filter;

class ApiController extends Controller
{
    protected $model;
    protected $is_auth_id = false;
    protected $string_user_id = 'user_id';
    protected $fillable_block = [];
    protected $store_request;
    protected $update_request;
    protected $q_request = [];

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // добавление или изменение зависимых данных
    protected static function extendsMutation($data, $request) {}

    protected static function getWhere(Request $request = null)
    {
        return [];
    }


    public function index(Request $request)
    {
        return new JsonResponse(
            Filter::all($request, $this->model, $this->fillable_block, $this::getWhere($request), $this->q_request)
        );
    }

    public function store(Request $request)
    {
        if ($this->store_request && !($this->store_request)->authorize() && AccessUtil::cannot('store', $this->model)) return AccessUtil::errorMessage();

        // данные для создания записи
        $create_data = $this->store_request ?
            [...$request->validate(
                ($this->store_request)->rules($request->all())
            )]
            :
            [...$request->all()];

        // нужен ли user_id для авторизации
        if ($this->is_auth_id) $create_data[$this->string_user_id] = auth()->id();

        $data = $this->model::create($create_data);

        $this::extendsMutation($data, $request);

        return new JsonResponse([
            'data' => Filter::one($request, $this->model, $data->id)
        ], 201);
    }

    public function show(Request $request, int $id)
    {
        return new JsonResponse([
            'data' => Filter::one($request, $this->model, $id, $this::getWhere($request))
        ]);
    }

    public function update(Request $request, int $id)
    {
        if ($this->update_request && !($this->update_request)->authorize()) return AccessUtil::errorMessage();

        $data = $this->model::findOrFail($id);

        if (AccessUtil::cannot('update', $data)) return AccessUtil::errorMessage();

        $data->update(
            $this->update_request
                ? $request->validate(($this->update_request)->rules([
                    ...$request->all(),
                    'id' => $id
                ])) : $request->all()
        );

        $this::extendsMutation($data, $request);

        return new JsonResponse([
            'data' => Filter::one($request, $this->model, $id, [])
        ]);
    }

    public function destroy(int $id)
    {
        $data = $this->model::findOrFail($id);

        if (AccessUtil::cannot('delete', $data)) return AccessUtil::errorMessage();

        $this->model::destroy($id);

        return new JsonResponse([
            'message' => 'Deleted'
        ]);
    }
}
