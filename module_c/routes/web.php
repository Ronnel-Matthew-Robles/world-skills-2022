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
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('logout');
    
    Route::get('/admin/user', [AdminUserController::class, 'index'])->name('admin.index');

    // Redirect all other requests
    Route::get('/', function() {
        return redirect('/admin/user');
    })->middleware('auth:web');

    Route::resource('user', UserController::class);
    Route::resource('user.lock', LockController::class);
    Route::post('/user/{user}/unlock', [UnlockController::class, 'store'])->withTrashed();

    Route::resource('game', GameController::class)->parameter('game', 'game:slug');
    Route::resource('score', ScoreController::class);

    Route::delete('/score/reset-game/{path}', [ScoreController::class, 'destroygGame'])->withTrashed();
});