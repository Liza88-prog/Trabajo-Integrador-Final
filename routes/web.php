<?php

use App\Http\Controllers\AcompanianteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\NovedadController;
use App\Http\Controllers\PersonalControlController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculoController;
use Illuminate\Support\Facades\Route;

// ---------------------------------------
// RUTAS DE AUTENTICACIÓN
// ---------------------------------------
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::get('me', [AuthController::class, 'me']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

// ---------------------------------------
// RUTAS DE PERSONAL CONTROL
// ---------------------------------------
Route::get('personal-control', [PersonalControlController::class, 'index']);
Route::post('personal-control', [PersonalControlController::class, 'store']);
Route::get('personal-control/{personal_control}', [PersonalControlController::class, 'show']);
Route::put('personal-control/{personal_control}', [PersonalControlController::class, 'update']);
Route::delete('personal-control/{personal_control}', [PersonalControlController::class, 'destroy']);

// ---------------------------------------
// RUTAS DE VEHÍCULOS
// ---------------------------------------
Route::get('vehiculo', [VehiculoController::class, 'index']);
Route::post('vehiculo', [VehiculoController::class, 'store']);
Route::get('vehiculo/{vehiculo}', [VehiculoController::class, 'show']);
Route::put('vehiculo/{vehiculo}', [VehiculoController::class, 'update']);
Route::delete('vehiculo/{vehiculo}', [VehiculoController::class, 'destroy']);

// ---------------------------------------
// RUTAS DE CONDUCTORES
// ---------------------------------------
Route::get('conductores', [ConductorController::class, 'index']);
Route::post('crear-conductores', [ConductorController::class, 'store']);
Route::get('conductores/{conductor}', [ConductorController::class, 'show']);
Route::put('conductores/{conductor}', [ConductorController::class, 'update']);
Route::delete('conductores/{conductor}', [ConductorController::class, 'destroy']);

// ---------------------------------------
// RUTAS DE ACOMPAÑANTES
// ---------------------------------------
Route::get('acompañante', [AcompanianteController::class, 'index']);
Route::post('acompañante', [AcompanianteController::class, 'store']);
Route::get('acompañante/{acompañante}', [AcompanianteController::class, 'show']);
Route::put('acompañante/{acompañante}', [AcompanianteController::class, 'update']);
Route::delete('acompañante/{acompañante}', [AcompanianteController::class, 'destroy']);

// ---------------------------------------
// RUTAS DE NOVEDADES
// ---------------------------------------
Route::get('novedades', [NovedadController::class, 'index']);
Route::post('novedades', [NovedadController::class, 'store']);
Route::get('novedades/{novedad}', [NovedadController::class, 'show']);
Route::put('novedades/{novedad}', [NovedadController::class, 'update']);
Route::delete('novedades/{novedad}', [NovedadController::class, 'destroy']);
