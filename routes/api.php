<?php

use App\Support\Route;

Route::get('/', 'WelcomeController@index');

Route::post('/register', 'RegisterController@store');