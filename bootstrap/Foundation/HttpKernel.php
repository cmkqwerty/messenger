<?php

namespace Boot\Foundation;

use Boot\Foundation\Bootstrappers\Bootstrapper;

class HttpKernel extends Kernel
{
    public array $middleware = [];

    public array $middlewareGroups = [
        'api' => [],
    ];

    public array $bootstrap = [
        Bootstrappers\LoadEnvironmentVariables::class,
        Bootstrappers\LoadDebugOptions::class,
        Bootstrappers\LoadAliases::class,
        Bootstrappers\LoadHttpMiddleware::class,
        Bootstrappers\LoadServiceProviders::class,
    ];
}