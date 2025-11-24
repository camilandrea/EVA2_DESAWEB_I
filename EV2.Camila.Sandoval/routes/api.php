<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user(); // Devuelve los datos del usuario autenticado
});

use App\Http\Controllers\ProyectoController;


Route::middleware('auth:api')->get('/proyectos', [ProyectoController::class, 'index']);      // Mostrar todos los proyectos
Route::middleware('auth:api')->post('/proyectos', [ProyectoController::class, 'store']);   // Crear un proyecto
Route::middleware('auth:api')->get('/proyectos/{id}', [ProyectoController::class, 'show']); // Ver un proyecto por ID
Route::middleware('auth:api')->put('/proyectos/{id}', [ProyectoController::class, 'update']); // Actualizar un proyecto
Route::middleware('auth:api')->delete('/proyectos/{id}', [ProyectoController::class, 'destroy']); // Eliminar un proyecto