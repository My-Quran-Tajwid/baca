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
        // Enable trusted proxy config is app running behing a reverse proxy so that the assets
        // URLs are generated correctly
        // NOTE: Can't use config() helpher here because the config is not loaded yet. Use environment instead.
        if (env('ENABLE_TRUSTED_PROXY_CONFIG', false)) {
            $middleware->trustProxies(env('TRUSTED_PROXIES', '*'));
        }
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
