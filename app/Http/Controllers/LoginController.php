<?php

namespace App\Http\Controllers;

use App\Support\RequestInput;
use App\Support\Auth;
use App\User;

class LoginController
{
    public function store(RequestInput $input, $response)
    {
        $token = '';
        $successful = Auth::attempt($input->email, sha1($input->password), $token);

        if (!$successful)
        {
            dd('Unsuccessful login');
        }

        $response->getBody()->write(json_encode([
            "token" => $token,
        ]), JSON_PRETTY_PRINT);

        return $response;
    }
}