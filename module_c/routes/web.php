<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
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
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', [AdminController::class, 'index'])->name('login');
Route::post('/admin', [AdminController::class, 'login']);

Route::middleware('auth:web')->group(function() {
    // Logging out
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('logout');

    // Displaying admin users
    Route::get('/admin/user', [AdminUserController::class, 'index'])->name('admin.users');

    // List of users
    Route::resource('user', UserController::class);

    // Blocking of user
    Route::resource('user.lock', LockController::class);

    // Unblocking of user
    Route::post('/user/{user}/unlock', [UnlockController::class, 'store'])->withTrashed();
    
    // Game routes
    Route::resource('game', GameController::class)->parameter('game', 'game:slug');

    // Score routes
    Route::resource('score', ScoreController::class);
    
    // Reset highscores
    Route::delete('/score/reset-game/{game}', [ScoreController::class, 'destroyGame'])->withTrashed();
});