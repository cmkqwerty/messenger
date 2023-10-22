<?php

namespace App\Http\Controllers;

use DB;

class WelcomeController
{
    public function index($response, DB $db)
    {
        //$users = $db->table('Users')->find(1);

        $response->getBody()->write(json_encode([
            'init' => 'init'
        ], JSON_PRETTY_PRINT));

        return $response;
    }
}