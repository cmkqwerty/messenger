<?php

require_once __DIR__ . '/../vendor/autoload.php';
$app = require_once base_path('bootstrap/app.php');

return
[
    'paths' => [
        'migrations' => database_path('migrations'),
        'seeds' => database_path('seeders')
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_database' => 'development',
        'production' => [
            'adapter' => 'sqlite',
            'name' => env('DB_DATABASE', database_path('database.sqlite')),
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'sqlite',
            'name' => env('DB_DATABASE', database_path('database.sqlite')),
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
