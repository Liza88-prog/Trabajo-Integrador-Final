<?php

use App\Http\Controllers\AcompanianteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConductorController;
use App\Http\Controllers\NovedadController;
use App\Http\Controllers\PersonalControlController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\ProductividadController;
use Illuminate\Support\Facades\Route;

// ---------------------------------------
// RUTAS DE AUTENTICACIÓN
// ---------------------------------------

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard'); 
})->name('dashboard');

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::get('me', [AuthController::class, 'me']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});
Route::prefix('personalcontrol')->name('personalcontrol.')->group(function () { 
    Route::get('/', [PersonalControlController::class, 'index'])->name('index');
    Route::get('/create', [PersonalControlController::class, 'create'])->name('create');
    Route::post('/', [PersonalControlController::class, 'store'])->name('store');
    Route::get('/{personal_control}/edit', [PersonalControlController::class, 'edit'])->name('edit');
    Route::put('/{personal_control}', [PersonalControlController::class, 'update'])->name('update');
    Route::delete('/{personal_control}', [PersonalControlController::class, 'destroy'])->name('destroy');


});
// ---------------------------------------
// RUTAS DE PERSONAL CONTROL
// ---------------------------------------
Route::resource('PersonalControl', PersonalControlController::class)->names('   PersonalControl');
// ---------------------------------------
// RUTAS DE VEHÍCULOS
// ---------------------------------------
Route::resource('vehiculo', VehiculoController::class);

// ---------------------------------------
// RUTAS DE CONDUCTORES
// ---------------------------------------
//Route::resource('conductores', ConductorController::class)->names('conductores'); 
Route::get('conductores', [ConductorController::class, 'index'])->name('conductores.index');
Route::get('conductores/create', [ConductorController::class, 'create'])->name('conductores.create');
Route::post('conductores', [ConductorController::class, 'store'])->name('conductores.store');
Route::get('conductores/{conductor}/edit', [ConductorController::class, 'edit'])->name('conductores.edit');
Route::put('conductores/{conductor}', [ConductorController::class, 'update'])->name('conductores.update');
Route::delete('conductores/{conductor}', [ConductorController::class, 'destroy'])->name('conductores.destroy');
Route::get('conductores/{conductor}', [ConductorController::class, 'show'])->name('conductores.show');

// ---------------------------------------
// RUTAS DE ACOMPAÑANTES
// ---------------------------------------
Route::resource('acompaniante', AcompanianteController::class);
/*Route::get('acompaniante', [AcompanianteController::class, 'index'])->name('acompaniante.index');
Route::post('acompañante', [AcompanianteController::class, 'store']);
Route::get('acompañante/{acompañante}', [AcompanianteController::class, 'show']);
Route::put('acompañante/{acompañante}', [AcompanianteController::class, 'update']);
Route::delete('acompañante/{acompañante}', [AcompanianteController::class, 'destroy']);*/

// ---------------------------------------
// RUTAS DE NOVEDADES
// ---------------------------------------
Route::get('novedades', [NovedadController::class, 'index']);
Route::post('novedades', [NovedadController::class, 'store']);
Route::get('novedades/{novedad}', [NovedadController::class, 'show']);
Route::put('novedades/{novedad}', [NovedadController::class, 'update']);
Route::delete('novedades/{novedad}', [NovedadController::class, 'destroy']);


// ---------------------------------------
// RUTAS DE PRODUCTIVIDAD// intente hacer un post para registrar productividad y hacer la prueba en postman
//pero me pide autenticacion, pero no pude logearme
// ---------------------------------------
Route::middleware(['auth'])->group(function () {
Route::get('/productividades', [ProductividadController::class, 'index'])->name('productividades.index');
Route::get('/productividades/create', function () {
        return view('productividades.create');
    })->name('productividades.create'); // 👈 esta muestra el formulario
Route::post('/productividades', [ProductividadController::class, 'store'])->name('productividades.store');
});