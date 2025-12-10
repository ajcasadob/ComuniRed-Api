<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ViviendaController;
use App\Http\Controllers\AccesoControlController;
use App\Http\Controllers\IncidenciaController;
use App\Http\Controllers\ComunicacionController;
use App\Http\Controllers\LecturaComunicacionController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\PagoController;

// Rutas públicas de autenticación
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Rutas protegidas con autenticación Sanctum
Route::middleware('auth:sanctum')->group(function () {
    
    // Autenticación
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Viviendas
    Route::apiResource('viviendas', ViviendaController::class);
    
    // Accesos de control
    Route::apiResource('accesos-control', AccesoControlController::class);
    
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
});
