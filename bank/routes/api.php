<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\AccountController;

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
    Route::apiResource('users', UserController::class);
    Route::apiResource('cards', CardController::class);
    Route::apiResource('operations', OperationController::class);
    Route::apiResource('currency', CurrencyController::class);
    Route::apiResource('accounts', AccountController::class);
});

