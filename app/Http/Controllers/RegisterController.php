<?php

namespace App\Http\Controllers;

use App\Support\Auth;
use App\Support\RequestInput;
use App\User;

class RegisterController
{
    public function store(RequestInput $input, $response)
    {
        $params = $input->all();

        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ];

        $validator = validator($params, $rules);

        if ($validator->fails())
        {
            $newResponse = $response->withStatus(400);

            $newResponse->getBody()->write(json_encode($validator->errors()), JSON_PRETTY_PRINT);

            return $newResponse;
        }

        $input->password = sha1($input->password);

        if (User::where('email', $input->email)->exists())
        {
            $newResponse = $response->withStatus(400);

            $newResponse->getBody()->write(json_encode([
                "error" => "User already exists.",
            ]), JSON_PRETTY_PRINT);

            return $newResponse;
        }

        $user = User::forceCreate($input->all());

        $token = '';
        Auth::attempt($user->email, $input->password, $token);

        $response->getBody()->write(json_encode([
            "is_created" => true,
            "user" => $user,
            "token" => $token,
        ]), JSON_PRETTY_PRINT);

        return $response;
    }
}