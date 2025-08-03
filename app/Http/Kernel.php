<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // middlewares globais, se houver
    ];

    protected $middlewareGroups = [
        'web' => [
            // middlewares padrão do Laravel
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'autenticar' => \App\Http\Middleware\AutenticarUsuario::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        // outros se houver
    ];
}
