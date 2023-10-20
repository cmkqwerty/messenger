<?php

use Slim\App;
use App\Http\Controllers\WelcomeController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) {
    $app->get('/', [WelcomeController::class, 'index']);
};