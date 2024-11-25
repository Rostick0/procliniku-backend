<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailCode\StoreEmailCodeRequest;
use App\Mail\AuthCode;
use App\Models\EmailCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailCodeController extends Controller
{
    public function store(StoreEmailCodeRequest $request)
    {
        EmailCode::where([
            ['email', '=', $request->email],
            ['type', '=', $request->type]
        ])->delete();

        $code = sprintf('%06d', rand(1, 1000000));

        $data = EmailCode::create([
            ...$request->validated(),
            'code' => $code,
        ]);

        Mail::to($request->email)->send(new AuthCode($code));

        return new JsonResponse([
            'message' => 'created'
        ]);
    }
}
