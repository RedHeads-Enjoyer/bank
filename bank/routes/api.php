<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\API\AuthController;

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


Route::group(['namespace' => 'App\Http\Controllers'], function (){
    Route::apiResource('currency', CurrencyController::class);
    Route::apiResource('accounts', AccountController::class);
});

Route::prefix('users')->controller(UserController::class)->group(function () {
    Route::get('me', 'me');
    Route::get('cookies', 'cookies');
    Route::get('', 'index');
    Route::get('{id}', 'show');
    Route::post('', 'store');
    Route::put('{id}', 'update');
    Route::delete('{id}', 'destroy');
});

Route::prefix('cards')->controller(CardController::class)->group(function () {
    Route::get('my', 'my');
    Route::get('', 'index');
    Route::get('{id}', 'show');
    Route::post('', 'store');
    Route::put('{id}', 'update');
    Route::delete('{id}', 'destroy');
});

Route::prefix('operations')->controller(OperationController::class)->group(function () {
    Route::get('my', 'my');
    Route::get('', 'index');
    Route::get('{id}', 'show');
    Route::post('', 'store');
    Route::put('{id}', 'update');
    Route::delete('{id}', 'destroy');
});

Route::prefix('auth')->middleware('api')->controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::get('user', 'user');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});


