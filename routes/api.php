<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JWTController;

Route::post('/signup', [JWTController::class, 'register']);
Route::post('/signin', [JWTController::class, 'login']);
Route::post('/signout', [JWTController::class, 'logout']);
Route::post('/refresh', [JWTController::class, 'refresh']);
Route::post('/profile', [JWTController::class, 'profile']);
