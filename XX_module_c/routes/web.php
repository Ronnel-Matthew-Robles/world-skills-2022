<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\PlatformUser\UserController;
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

Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');

Route::prefix('admin')->group(function() {
    Route::get('/', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/', [AdminLoginController::class, 'login']);
    
    Route::get('/dashboard', [AdminUserController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/admin_users', [AdminUserController::class, 'index'])->name('admin.admin_users.index');
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    
    Route::get('/games', [GameController::class, 'index'])->name('admin.games.index');
    Route::get('/game/{slug}/{version_id?}', [GameController::class, 'show'])->name('admin.games.profile');
    Route::post('/game/{slug}/reset', [GameController::class, 'reset'])->name('admin.games.reset');
    Route::post('/game/{slug}/delete/{score_id}', [GameController::class, 'deletePlayerScore'])->name('admin.games.delete.player.score');
    Route::post('/game/{slug}/{player_id}/reset', [GameController::class, 'deleteAllPlayerScores'])->name('admin.games.delete.all.player.scores');
});

Route::get('/user/{username}', [UserController::class, 'show'])->name('platform.user.profile');

Route::post('/users/{username}/block', [UserController::class, 'block'])->name('platform.users.block');
Route::post('/users/{username}/unblock', [UserController::class, 'unblock'])->name('platform.users.unblock');