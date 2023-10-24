<?php

namespace App\Providers;

use Boot\Foundation\Http\ValidatorFactory;
use Illuminate\Translation\Translator;

class ValidatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->bind(ValidatorFactory::class, fn (Translator $translator) => new ValidatorFactory($translator));
    }

    public function boot()
    {

    }
}