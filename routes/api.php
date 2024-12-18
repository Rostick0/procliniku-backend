<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\EmailCodeController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::name('api.')
    ->middleware('api')
    ->group(function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:300,1');
            Route::post('/register', [AuthController::class, 'register']);

            Route::group(['middleware' => 'jwt'], function () {
                Route::post('/logout', [AuthController::class, 'logout']);
                Route::post('/refresh', [AuthController::class, 'refresh']);
                Route::get('/me', [AuthController::class, 'me']);
            });
        });

        Route::apiResource('files', FileController::class)->only(['store', 'show', 'destroy']);
        Route::apiResource('images', ImageController::class)->only(['store', 'show', 'destroy']);

        Route::post('/email-code', [EmailCodeController::class, 'store']);

        Route::get('/clinics/link/{link_name}', [ClinicController::class, 'showByLinkName']);

        Route::apiResource('regions', RegionController::class)->only(['index', 'show']);
        Route::apiResource('cities', CityController::class)->only(['index', 'show']);

        Route::apiResource('service-types', ServiceTypeController::class)->only(['index']);
        Route::apiResource('service-categories', ServiceCategoryController::class)->only(['index']);

        Route::apiResource('appointments', AppointmentController::class)->only(['index', 'show']);

        Route::apiResource('favorites', FavoriteController::class)->only(['index', 'store']);
        Route::delete('/favorites/{clinic_id}', [FavoriteController::class, 'destroy']);

        Route::apiResources([
            'clinics' => ClinicController::class,
            'reviews' => ReviewController::class,
            'categories' => CategoryController::class,
            'services' => ServiceController::class
        ]);
    });
