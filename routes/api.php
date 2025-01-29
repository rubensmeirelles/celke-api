<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

//Rota pública
Route::post('/login', [LoginController::class, 'login'])->name('login');

//Rota privada - precisa do token
Route::group(['middleware' => ['auth:sanctum']], function(){

    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/{user}', [UserController::class, 'show']);
    Route::post('/user', [UserController::class, 'store']);
    Route::put('/user/{user}', [UserController::class, 'update']);
    Route::put('/user-password/{user}', [UserController::class, 'updatePassword']);
    Route::delete('/user/{user}', [UserController::class, 'destroy']);

});
