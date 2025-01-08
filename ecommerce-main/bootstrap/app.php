<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\EditorMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'stripe/*',
            'http://127.0.0.1:8000/category-store',
            'http://127.0.0.1:8000/category-update',
            'http://127.0.0.1:8000/category-delete',
        ]);
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'editor' => EditorMiddleware::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
