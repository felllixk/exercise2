<?php

namespace App\Providers;

use App\Facades\Modular;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('modular', fn () => new \App\Modules\Modular());
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Modular::setViewsFolder();
    }
}
