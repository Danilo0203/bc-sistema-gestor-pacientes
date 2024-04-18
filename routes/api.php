<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\EstadoCivilController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\ProfesionController;

// Rutas de autenticación
Route::prefix('auth')->group(function(){
    Route::post('register', [AuthController::class, 'register'])->middleware('auth:sanctum');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function(){
    
    // Rutas de roles, leer, crear, actualizar y eliminar
    Route::apiResource('roles', RolController::class);

    // Rutas para departamentos, leer, crear, actualizar y eliminar
    Route::apiResource('departamentos', DepartamentoController::class);

    // Rutas para municipios, leer, crear, actualizar y eliminar
    Route::apiResource('municipios', MunicipioController::class);

    // Rutas para direcciones, leer, crear, actualizar y eliminar
    Route::apiResource('direcciones', DireccionController::class);

    // Rutas para el estado civil del paciente, leer, crear, actualizar y eliminar
    Route::apiResource('estado-civil', EstadoCivilController::class);

    // Rutas para los generos del paciente, leer, crear, actualizar y eliminar
    Route::apiResource('generos', GeneroController::class);

    // Rutas para las profesiones del paciente, leer, crear, actualizar y eliminar
    Route::apiResource('profesiones', ProfesionController::class);
});