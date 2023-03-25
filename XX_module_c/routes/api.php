<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\ScoreController;
use App\Http\Controllers\Api\AssetController;
use App\Http\Controllers\Api\UploadController;
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

Route::prefix('v1/auth')->group(function() {
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/signin', [AuthController::class, 'signin']);
    Route::middleware('auth:sanctum')->post('/signout', [AuthController::class, 'signout']);
});

Route::prefix('v1/games')->group(function() {
    Route::get('/', [GameController::class, 'index']);
    Route::middleware('auth:sanctum')->post('/', [GameController::class, 'store']);
    Route::get('/{slug}', [GameController::class, 'show']);
    Route::middleware('auth:sanctum')->post('/{slug}/upload');
    // Route::get('/{slug}/{version}');
    // Route::put('/{slug}');
    // Route::delete('/{slug}');
    Route::get('/{slug}/scores', [ScoreController::class, 'index']);
    Route::middleware('auth:sanctum')->post('/{slug}/scores', [ScoreController::class, 'store']);
});

Route::prefix('v1/users')->group(function() {
    Route::get('/{username}');

});