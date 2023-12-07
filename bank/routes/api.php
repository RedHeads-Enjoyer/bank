<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\API\AuthController;


Route::prefix('users')->controller(UserController::class)->group(function () {
    // Вывод информации о себе
    Route::get('me', 'me');
    // Получение куки
    Route::get('cookies', 'cookies');
    // Получение всех пользователей
    Route::get('', 'index');
    // Получение пользователя по id
    Route::get('{id}', 'show');
    // Создание пользователя
    Route::post('', 'store');
    // Изменение пользователя
    Route::put('{id}', 'update');
    // Удаление пользователя
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

Route::prefix('accounts')->controller(AccountController::class)->group(function () {
    Route::get('my', 'my');
    Route::get('', 'index');
    Route::get('{id}', 'show');
    Route::post('', 'store');
    Route::put('{id}', 'update');
    Route::delete('{id}', 'destroy');
});

Route::prefix('currencies')->controller(CurrencyController::class)->group(function () {
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


