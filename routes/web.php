<?php

use App\Http\Controllers\ParticleController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SpaceController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [RegisterController::class, 'view']);
Route::get('/login', [LoginController::class, 'view']);
Route::get('/logout', [LoginController::class, 'logOutUser']);

Route::resource('spaces', SpaceController::class)
    ->middleware('can:create,App\Models\Space');

Route::post('/spaces/{space}/particles', [ParticleController::class, 'store'])
    ->name('particles.store');

Route::get('/account/edit', [UserController::class, 'edit']);
Route::post('/account', [UserController::class, 'update'])
    ->name('user.edit');

Route::post('/users', [RegisterController::class, 'registerUser']);
Route::post('/users/login', [LoginController::class, 'loginUser']);
