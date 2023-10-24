<?php

namespace App\Http\Controllers;

use App\Support\RequestInput;
use App\Support\Auth;
use App\User;

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
            dd($validator->errors());
        }

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