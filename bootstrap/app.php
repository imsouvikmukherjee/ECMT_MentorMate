<?php

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
        $middleware->alias([
            'isStudent' => \App\Http\Middleware\IsAdmin::class,
            'isAdmin' => \App\Http\Middleware\IsStudent::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
