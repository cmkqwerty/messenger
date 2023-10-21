<?php

namespace App\Http;

use Boot\Foundation\HttpKernel as Kernel;

class HttpKernel extends Kernel
{
    public array $middleware = [
        Middleware\ExampleAfterMiddleware::class,
        Middleware\ExampleBeforeMiddleware::class
    ];

    public array $middlewareGroups = [
        'api' => []
    ];
}