<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['validator']->extend('keywords_count', function ($attribute, $value, $parameters) {
            return sizeof(explode(',', rtrim(trim($value), ','))) <= $parameters[0];
        });

        $this->app['validator']->replacer('keywords_count', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':count', $parameters[0], $message);
        });

        $this->app['validator']->extend('is_optimizer', function ($attribute, $userId, $parameters) {
            $user = User::find($userId);
            return $user && $user->isOptimizer();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
