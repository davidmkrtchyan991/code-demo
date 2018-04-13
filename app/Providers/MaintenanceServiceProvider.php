<?php

namespace App\Providers;

use App\Services\MaintenanceService;
use Illuminate\Support\ServiceProvider;

class MaintenanceServiceProvider extends ServiceProvider
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
        $this->app->singleton('maintenanceService', function ($app) {
            return new MaintenanceService();
        });
    }
}
