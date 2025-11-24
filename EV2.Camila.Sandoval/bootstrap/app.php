<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',     // Rutas estándar (vistas, sesión)
        api: __DIR__.'/../routes/api.php',     // ¡Añadido! Rutas para API (sin estado)
        commands: __DIR__.'/../routes/console.php', // Rutas para comandos en consola
        health: '/up',     // Ruta de estado
    )
    ->withMiddleware(function (Middleware $middleware) {
        // El middleware 'api' se aplica automáticamente a routes/api.php.
        // Aquí solo agregarías middleware global.
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Manejo de excepciones
    })
    ->create();