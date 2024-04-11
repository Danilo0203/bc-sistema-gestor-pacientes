<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;


// Rutas de autenticación
Route::prefix('auth')->group(function(){
    Route::post('register', [AuthController::class, 'register'])->middleware('auth:sanctum');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function(){
});