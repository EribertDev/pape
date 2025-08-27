<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class JitsiServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/jitsi.php', 'jitsi'
        );
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/jitsi.php' => config_path('jitsi.php'),
        ]);
    }
}