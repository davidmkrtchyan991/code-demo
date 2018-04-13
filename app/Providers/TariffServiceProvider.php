<?php

namespace App\Providers;

use App\Services\OrderService;
use App\Services\TariffService;
use Illuminate\Support\ServiceProvider;

class TariffServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('tariffService', function ($app) {
            return new TariffService();
        });
    }
}
