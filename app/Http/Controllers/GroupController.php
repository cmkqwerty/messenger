<?php

namespace App\Http\Controllers;

use App\Support\RequestInput;
use App\Support\Auth;
use App\Group;
use App\Message;
use App\UserGroupMatch;

class GroupController
{
    public function store(RequestInput $input, $response)
    {
        $params = $input->all();

        $rules = [
            'name' => 'required|string',
        ];

        $validator = validator($params, $rules);

        if ($validator->fails())
        {
            $newResponse = $response->withStatus(400);

            $newResponse->getBody()->write(json_encode($validator->errors()), JSON_PRETTY_PRINT);

            return $newResponse;
        }

        $group = Group::forceCreate($input->all());

        $response->getBody()->write(json_encode([
            "is_created" => true,
            "group" => $group,
        ]), JSON_PRETTY_PRINT);

        return $response;
    }

    public function list($response)
    {
        $groups = Group::all();

        $response->getBody()->write(json_encode($groups), JSON_PRETTY_PRINT);

        return $response;
    }

    public function join($request, $response, $group_id)
    {
        $user_id = $request->getAttribute('token')['data']->id;

        $params = ['group_id' => $group_id];

        $rules = [
            'group_id' => 'required|integer',
        ];

        $validator = validator($params, $rules);

        if ($validator->fails())
        {
            $newResponse = $response->withStatus(400);

            $newResponse->getBody()->write(json_encode($validator->errors()), JSON_PRETTY_PRINT);

            return $newResponse;
        }

        $userGroupMatch = UserGroupMatch::forceCreate([
            'user_id' => $user_id,
            'group_id' => $group_id
        ]);

        $response->getBody()->write(json_encode([
            "is_joined" => true,
        ]), JSON_PRETTY_PRINT);

        return $response;
    }

    public function listMessages($request, $response, $group_id)
    {
        $user_id = Auth::user($request);

        $params = ['group_id' => $group_id];

        $rules = [
            'group_id' => 'required|integer',
        ];

        $validator = validator($params, $rules);

        if ($validator->fails())
        {
            $newResponse = $response->withStatus(400);

            $newResponse->getBody()->write(json_encode($validator->errors()), JSON_PRETTY_PRINT);

            return $newResponse;
        }

        if (!(Auth::isUserInGroup($user_id, $group_id)))
        {
            $newResponse = $response->withStatus(403);

            $newResponse->getBody()->write(json_encode([
                "error" => "You should first join the group.",
            ]), JSON_PRETTY_PRINT);

            return $newResponse;
        }

        $messages = Message::where('group_id', $group_id)->get();

        $response->getBody()->write(json_encode($messages), JSON_PRETTY_PRINT);

        return $response;
    }

    public function sendMessage($request, RequestInput $input, $response, $group_id)
    {
        $user_id = Auth::user($request);

        $params = ['group_id' => $group_id, 'content' => $input->content];

        $rules = [
            'group_id' => 'required|integer',
            'content' => 'required|string',
        ];

        $validator = validator($params, $rules);

        if ($validator->fails())
        {
            $newResponse = $response->withStatus(400);

            $newResponse->getBody()->write(json_encode($validator->errors()), JSON_PRETTY_PRINT);

            return $newResponse;
        }

        if (!(Auth::isUserInGroup($user_id, $group_id)))
        {
            $newResponse = $response->withStatus(403);

            $newResponse->getBody()->write(json_encode([
                "error" => "You should first join the group.",
            ]), JSON_PRETTY_PRINT);

            return $newResponse;
        }

        $message = Message::forceCreate([
            'group_id' => $group_id,
            'user_id' => $user_id,
            'content' => $input->content
        ]);

        $response->getBody()->write(json_encode([$message]), JSON_PRETTY_PRINT);

        return $response;
    }
}