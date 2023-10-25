<?php

namespace App\Http;

use Boot\Foundation\HttpKernel as Kernel;

class HttpKernel extends Kernel
{
    public array $middleware = [
        Middleware\RouteContextMiddleware::class,
    ];

    public array $middlewareGroups = [
        'api' => []
    ];
}