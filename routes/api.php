<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{user}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);
Route::put('/user/{user}', [UserController::class, 'update']);
Route::put('/user-password/{user}', [UserController::class, 'updatePassword']);
Route::delete('/user/{user}', [UserController::class, 'destroy']);
