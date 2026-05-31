<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // If app is running behind a reverse proxy, we need to trust the proxy to get correct IP/scheme.
        // So that the CSS and other files can be served correctly.
        if (env('ENABLE_TRUSTED_PROXY_CONFIG', false)) {
            $middleware->trustProxies(env('TRUSTED_PROXIES', '*'));
        }
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
