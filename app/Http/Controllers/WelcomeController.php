<?php

namespace App\Http\Controllers;

class WelcomeController
{
    public function index($response)
    {
        $response->getBody()->write('init');

        return $response;
    }
}