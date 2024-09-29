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
            __DIR__ . '/../resources/views/components/outline' => resource_path('views/components/outline'),
        ], 'outline');
    }
}
