<?php

namespace App\Http\Controllers;

use App\Enum\UserRole;
use App\Http\Requests\ClinicWorker\StoreClinicWorkerRequest;
use App\Mail\CreateClinicWorker;
use App\Models\Clinic;
use App\Models\ClinicWorker;
use App\Models\User;
use App\Utils\AccessUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Rostislav\LaravelFilters\Filter;

class ClinicWorkerController extends ApiController
{
    public function __construct()
    {
        $this->model = new ClinicWorker;
        $this->store_request = new StoreClinicWorkerRequest;
    }

    public function store(Request $request)
    {
        if (!($this->store_request)->authorize()) return AccessUtil::errorMessage();

        $create_data = [...$request->validate(
            ($this->store_request)->rules($request->all())
        )];

        $user_password = Str::random(10);
        $user = User::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'role' => UserRole::worker->value,
                'password' => $user_password
            ]
        );

        if ($user->role === UserRole::client->value) {
            $user->update([
                'role' => UserRole::worker->value,
            ]);
        }

        $data = $this->model::firstOrCreate(
            [
                'clinic_id' => $request->clinic_id,
                'user_id' => $user->id
            ],
            ['role' => $request->role]
        );

        if ($user->wasRecentlyCreated) {
            Mail::to($user)->send(new CreateClinicWorker(
                Clinic::firstWhere('id', $request->clinic_id),
                $user_password
            ));
        }

        return new JsonResponse([
            'data' => Filter::one($request, $this->model, $data->id)
        ], 201);
    }
}
