<?php

use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserAuthController;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::post('register', [UserAuthController::class, 'register']);
Route::post('login', [UserAuthController::class, 'login']);
Route::post('logout', [UserAuthController::class, 'logout'])
    ->middleware('auth:sanctum');

// Task routes
Route::apiResource('tasks', TaskController::class)->except('show')->middleware('auth:sanctum');
