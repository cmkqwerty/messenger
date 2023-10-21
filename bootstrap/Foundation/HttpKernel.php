<?php

namespace Boot\Foundation;

class HttpKernel extends Kernel
{
    public array $middleware = [];

    public array $middlewareGroups = [
        'api' => [],
    ];

    public array $bootstrap = [
        Bootstrappers\LoadEnvironmentVariables::class,
        Bootstrappers\LoadDebugOptions::class,
        Bootstrappers\LoadHttpMiddleware::class,
        Bootstrappers\LoadServiceProviders::class,
    ];
}