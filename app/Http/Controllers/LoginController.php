<?php

namespace App\Http\Controllers;

use App\Support\RequestInput;
use App\Support\Auth;

class LoginController
{
    public function store(RequestInput $input, $response)
    {
        $params = $input->all();

        $rules = [
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

        $token = '';
        $successful = Auth::attempt($input->email, sha1($input->password), $token);

        if (!$successful)
        {
            $newResponse = $response->withStatus(403);

            $newResponse->getBody()->write(json_encode([
                    "error" => "Unsuccessful login.",
                ]
            ), JSON_PRETTY_PRINT);

            return $newResponse;
        }

        $response->getBody()->write(json_encode([
            "token" => $token,
        ]), JSON_PRETTY_PRINT);

        return $response;
    }
}