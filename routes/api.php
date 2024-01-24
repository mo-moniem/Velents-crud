<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

Route::post('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);
Route::middleware('auth:api')->group(function () {
    Route::get('profile', [AuthController::class,'profile']);
    Route::post('logout', [AuthController::class,'logout']);
});
Route::apiResource('users', UserController::class);
