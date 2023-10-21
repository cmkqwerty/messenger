<?php

return [
    'name' => env('APP_NAME', 'Messenger Slim Chat'),
    'providers' => [
        \App\Providers\EnvironmentVariablesServiceProvider::class,
        \App\Providers\RouteServiceProvider::class,
        \App\Providers\ErrorMiddlewareServiceProvider::class,
    ]
];