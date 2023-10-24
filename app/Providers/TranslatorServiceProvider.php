<?php

namespace App\Providers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;

class TranslatorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->getContainer()->set(FileLoader::class, fn (Filesystem $files) => new FileLoader($files, config('translate.path')));

        $this->app->getContainer()->set(Translator::class, function (FileLoader $loader) {
            $loader->addNamespace('languages', config('translate.path'));
            $loader->load(config('app.locale'), 'validation', 'lang');

            return new Translator($loader, config('app.locale'));
        });
    }

    public function boot()
    {

    }
}