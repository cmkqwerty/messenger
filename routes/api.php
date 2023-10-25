<?php

use App\Support\Route;

Route::get('/', 'WelcomeController@index');

Route::post('/register', 'RegisterController@store');
Route::post('/login', 'LoginController@store');

Route::post('/groups', 'GroupController@store')->add(new Tuupola\Middleware\JwtAuthentication([
    "attribute" => "token",
    "secret" => env('SECRET_KEY')
]));
Route::get('/groups', 'GroupController@list')->add(new Tuupola\Middleware\JwtAuthentication([
    "attribute" => "token",
    "secret" => env('SECRET_KEY')
]));
Route::post('/groups/{group_id}/join', 'GroupController@join')->add(new Tuupola\Middleware\JwtAuthentication([
    "attribute" => "token",
    "secret" => env('SECRET_KEY')
]));
Route::get('/groups/{group_id}/messages', 'GroupController@listMessages')->add(new Tuupola\Middleware\JwtAuthentication([
    "attribute" => "token",
    "secret" => env('SECRET_KEY')
]));
Route::post('/groups/{group_id}/messages', 'GroupController@sendMessage')->add(new Tuupola\Middleware\JwtAuthentication([
    "attribute" => "token",
    "secret" => env('SECRET_KEY')
]));