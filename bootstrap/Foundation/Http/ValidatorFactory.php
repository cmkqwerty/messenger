<?php

namespace Boot\Foundation\Http;

use Illuminate\Validation\Factory;

class ValidatorFactory
{
    protected Factory $factory;

    public function __construct($translator)
    {
        $this->factory = new Factory($translator);
    }

    public function __call($method, $parameters)
    {
        return call_user_func_array([$this->factory, $method], $parameters);
    }
}