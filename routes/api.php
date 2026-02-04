<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ViviendaController;
use App\Http\Controllers\AccesoControlController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\ComunicacionController;
use App\Http\Controllers\LecturaComunicacionController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;


use Illuminate\Http\Request;


// Rutas públicas de autenticación
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Rutas protegidas con autenticación Sanctum
Route::middleware('auth:sanctum')->group(function () {
    
    // Autenticación
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Usuarios (añadir después de la línea de Viviendas)
    Route::patch('usuarios/{usuario}/asignarvivienda', [UserController::class, 'asignarVivienda']);
    
    Route::apiResource('usuarios', UserController::class)->except(['store']); // store ya está en register
    
    // Viviendas
    Route::apiResource('viviendas', ViviendaController::class);
    
    

    
    // Incidencias
    Route::apiResource('incidencias', IncidenciaController::class);
    
    // Comunicaciones
    Route::apiResource('comunicaciones', ComunicacionController::class);
    
    // Lecturas de comunicaciones
    Route::apiResource('lecturas-comunicacion', LecturaComunicacionController::class);
    
    // Reservas
    Route::apiResource('reservas', ReservaController::class);
    
    // Pagos
    Route::apiResource('pagos', PagoController::class);
    Route::get('/dashboard/estadisticas', [DashboardController::class, 'getEstadisticas']);
});
