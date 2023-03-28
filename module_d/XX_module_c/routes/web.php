<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\Games\UploadController;
use App\Http\Controllers\Game\StaticController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\User\LockController;
use App\Http\Controllers\User\UnlockController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Logging in
Route::get('/admin', [AdminController::class, 'index'])->name('login');
Route::post('/admin', [AdminController::class, 'login']);

Route::middleware('auth:web')->group(function() {
    // Logging out
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('logout');

    // Displaying all admin users
    Route::get('/admin/user', [AdminUserController::class, 'index']);

    // Redirecting to home
    Route::get('/', function() {
        return redirect('/admin/user');
    })->middleware('auth:web');

    // List of users
    Route::resource('user', UserController::class);
    // Block a user
    Route::resource('user.lock', LockController::class);
    // Unblock a user
    Route::post('/user/{user}/unlock', [UnlockController::class, 'store'])->withTrashed();

    // Game routes
    Route::resource('game', GameController::class)->parameter('game', 'game:slug');

    // Delete a score
    Route::resource('score', ScoreController::class);
    // Reset high scores
    Route::delete('/score/reset-game/{game}', [ScoreController::class, 'destroyGame'])->withTrashed();
});

Route::get('/game/{game}/{path}', [StaticController::class, 'index'])->withTrashed()->name('game.static')->where('path', '(.*)');
Route::resource('/api/v1/games/{game}/upload', UploadController::class);