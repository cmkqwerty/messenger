<?php

namespace App\Support;

class RequestInput
{
    protected array $meta;
    protected array $attributes;

    public function __construct($request, $route)
    {
        $this->meta = [
            'name' => $route->getName(),
            'groups' => $route->getGroups(),
            'methods' => $route->getMethods(),
            'arguments' => $route->getArguments(),
            'currentUri' => $request->getUri()
        ];

        $this->attributes = $request->getParsedBody() ?? [];
    }

    public function all()
    {
        return $this->attributes;
    }
}