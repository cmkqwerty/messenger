<?php

namespace App\Support;

use \App\User;
use \App\Support\Token;

class Auth
{
    public static function attempt($email, $password, &$token)
    {
        $user = User::where('email', $email);

        if (!$user->exists())
        {
            return false;
        }

        $user = $user->first();

        if ($password !== $user->password)
        {
            dd("Wrong credentials");

            return false;
        }

        $token = Token::generateToken([
            'id' => $user->id,
            'email' => $user->email,
        ]);

        return true;
    }

    public static function user()
    {
        $query = User::where($_SESSION['user']);

        return $query->exists() ? $query->first() : false;
    }

    public static function check() : bool
    {
        return (bool) self::user();
    }

    public static function guest() : bool
    {
        return !self::check();
    }
}