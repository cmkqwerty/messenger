<?php

return [
    'name' => env('APP_NAME', 'Messenger Slim Chat'),
    'providers' => [
        \App\Providers\DatabaseServiceProvider::class,
        \App\Providers\RouteServiceProvider::class
    ],
    'aliases' => [
        'DB' => \Illuminate\Database\Capsule\Manager::class,

    ]
];