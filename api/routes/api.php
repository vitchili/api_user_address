<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::prefix('user')->group(function () {
    Route::get('/',     [UserController::class, 'read']);
    Route::post('/',    [UserController::class, 'create']);
    Route::put('/',     [UserController::class, 'update']);
    Route::delete('/',  [UserController::class, 'delete']);
});

Route::prefix('address')->group(function () {
    Route::get('/',     [AddressController::class, 'read']);
    Route::post('/',    [AddressController::class, 'create']);
    Route::put('/',     [AddressController::class, 'update']);
    Route::delete('/',  [AddressController::class, 'delete']);
});

Route::get('/city',     [CityController::class, 'read']);
Route::get('/state',    [StateController::class, 'read']);
