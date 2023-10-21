<?php

namespace App\Http\Controllers;

class WelcomeController
{
    public function index($response)
    {
        $response->getBody()->write(json_encode([
            'init' => 'init'
        ], JSON_PRETTY_PRINT));

        return $response;
    }
}