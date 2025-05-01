<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ScheduleController;
use App\Http\Controllers\API\ZoneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['prefix' => 'v1'], function () {

    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login'])->name('login');

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::get('user', [AuthController::class, 'user']);
        });
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('zones', ZoneController::class);

        Route::prefix('zones')->group(function () {
            Route::post('{zone}/start-watering', [ZoneController::class, 'startWatering']);
            Route::post('{zone}/stop-watering', [ZoneController::class, 'stopWatering']);
            Route::get('{zone}/watering-status', [ZoneController::class, 'wateringStatus']);
            Route::get('{zone}/schedules', [ScheduleController::class, 'index']);
            Route::post('{zone}/schedules', [ScheduleController::class, 'store']);
            Route::get('{zone}/schedules/{schedule}', [ScheduleController::class, 'show']);
            Route::put('{zone}/schedules/{schedule}', [ScheduleController::class, 'update']);
            Route::delete('{zone}/schedules/{schedule}', [ScheduleController::class, 'destroy']);
        });
    });

});
