<?php

use App\Http\Controllers\Api\Auth\SigninController;
use App\Http\Controllers\Api\Auth\SignoutController;
use App\Http\Controllers\Api\Auth\SignupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/v1')->group(function() {
    Route::apiResource('auth/signin', SigninController::class);
    Route::apiResource('auth/signout', SignoutController::class);
    Route::apiResource('auth/signup', SignupController::class);
});