<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\EmailCodeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('v1')
    ->name('api.')
    ->middleware('api')
    ->group(function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:300,1');
            Route::post('/register', [AuthController::class, 'register']);

            // 'middleware' => 'jwt'
            Route::group(['middleware' => 'jwt'], function () {
                Route::post('/logout', [AuthController::class, 'logout']);
                Route::post('/refresh', [AuthController::class, 'refresh']);
                Route::get('/me', [AuthController::class, 'me']);
            });
        });

        Route::apiResource('files', FileController::class)->only(['store', 'show', 'destroy']);
        Route::apiResource('images', ImageController::class)->only(['index', 'store', 'show', 'destroy']);

        Route::post('/email-code', [EmailCodeController::class, 'store']);

        Route::apiResources([
            'clinics' => ClinicController::class,
            'reviews' => ReviewController::class,
            'categories' => CategoryController::class,
            'services' => ServiceController::class
        ]);
    });
