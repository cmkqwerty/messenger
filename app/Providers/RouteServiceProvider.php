<?php

namespace App\Providers;

use App\Support\RouteGroup;
use App\Support\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function register()
    {
        Route::setup($this->app);

        $this->bind(RouteGroup::class, fn () => new RouteGroup($this->app));
    }

    public function boot()
    {
        $this->apiRouteGroup()->register();
    }

    public function apiRouteGroup() : RouteGroup
    {
        $get = routes_path('api.php');
        $add = $this->resolve('middleware');
        $api = $this->resolve(RouteGroup::class);

        return $api->routes($get)->prefix('/api')->middleware([
            ...$add['api'],
            ...$add['global']
        ]);
    }
}