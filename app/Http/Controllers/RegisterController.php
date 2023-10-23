<?php

namespace App\Http\Controllers;

use App\Support\Auth;
use App\Support\RequestInput;
use App\User;

class RegisterController
{
    public function store(RequestInput $input, $response)
    {
        $input->password = sha1($input->password);

        if (User::where('email', $input->email)->exists())
        {
            dd('Email already exists');
        }

        $user = User::forceCreate($input->all());

        Auth::attempt($user->email, $input->password);

        $response->getBody()->write(json_encode([
            "is_created" => true,
        ]), JSON_PRETTY_PRINT);

        return $response;
    }
}