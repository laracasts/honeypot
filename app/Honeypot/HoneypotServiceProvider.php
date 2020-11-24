<?php

namespace App\Honeypot;

use App\Honeypot\View\Components\Honeypot as HoneypotComponent;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class HoneypotServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/honeypot.php', 'honeypot');
    }

    public function boot()
    {
        $this->app->singleton(Honeypot::class, function () {
            return new Honeypot(
                $this->app['request'],
                $this->app['config']->get('honeypot')
            );
        });

        Blade::component('honeypot', HoneypotComponent::class);
    }
}
