<?php

namespace App\Providers;

use App\Services\ChecklistService;
use Illuminate\Support\ServiceProvider;

class ChecklistServiceProvider extends ServiceProvider
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
        $this->app->singleton('checklistService', function ($app) {
            return new ChecklistService();
        });
    }
}
