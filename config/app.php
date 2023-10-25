<?php

return [
    'name' => env('APP_NAME', 'Messenger Slim Chat'),
    'env' => env('APP_ENV', 'production'),
    'app_debug' => env('APP_DEBUG', false),
    'timezone' => 'UTC',
    'locale' => 'en',
    'faker_locale' => 'en_US',
    'providers' => [
        \App\Providers\DatabaseServiceProvider::class,
        \App\Providers\RouteServiceProvider::class,
        \App\Providers\TranslatorServiceProvider::class,
        \App\Providers\ValidatorServiceProvider::class
    ],
    'aliases' => [
        'Auth' => \App\Support\Auth::class,
        'DB' => \Illuminate\Database\Capsule\Manager::class,
    ]
];