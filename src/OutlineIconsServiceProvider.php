<?php

namespace UnReact;

use Illuminate\Support\ServiceProvider;

class OutlineIconsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->commands([
            ConvertIconsCommand::class,
        ]);
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../resources/views/components/icons' => resource_path('views/components/icons'),
        ], 'icons');
    }
}
