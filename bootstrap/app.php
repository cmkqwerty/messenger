<?php

use DI\Container;
use App\Http\HttpKernel;
use DI\Bridge\Slim\Bridge as App;

$app = App::create(new Container);
$_SERVER['app'] = $app;

if (!function_exists('app'))
{
    function app()
    {
        return $_SERVER['app'];
    }
}

$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();

return HttpKernel::bootstrap($app)->getApplication();