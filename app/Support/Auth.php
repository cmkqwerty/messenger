<?php

namespace App\Support;

use \App\User;
use \App\UserGroupMatch;

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
            return false;
        }

        $token = Token::generateToken([
            'id' => $user->id,
            'email' => $user->email,
        ]);

        return true;
    }

    public static function user($request)
    {
        $id = $request->getAttribute('token')['data']->id;

        return $id;
    }

    public static function isUserInGroup($user_id, $group_id)
    {
        return UserGroupMatch::where('user_id', $user_id)
            ->where('group_id', $group_id)
            ->exists();
    }
}