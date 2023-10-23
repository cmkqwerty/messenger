<?php

namespace App\Http\Controllers;

use App\Support\RequestInput;
use App\Support\Auth;
use App\User;

class LoginController
{
    public function store(RequestInput $input, $response)
    {
        $successful = Auth::attempt($input->email, sha1($input->password));

        if (!$successful)
        {
            dd('Unsuccessful login');
        }

        return redirect('/login');
    }
}