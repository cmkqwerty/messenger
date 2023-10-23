<?php

use App\Support\Route;

Route::get('/', 'WelcomeController@index');

Route::post('/register', 'RegisterController@store');
Route::post('/login', 'LoginController@store');
/*
Route::post('/groups', 'GroupController@create');
Route::get('/groups', 'GroupController@list');
Route::post('/groups/join', 'GroupController@join');
Route::get('/groups/messages', 'GroupController@listMessages');
Route::post('/groups/messages', 'GroupController@SendMessage');
*/