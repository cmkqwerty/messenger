<?php

namespace App\Http\Controllers;

use App\Support\RequestInput;

class RegisterController
{
    public function store(RequestInput $input)
    {
        dd($input->all());
        return redirect('/');
    }
}