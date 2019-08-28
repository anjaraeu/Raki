<?php

namespace App\Providers;

use Exception;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Debug\Exception\FatalThrowableError;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('MIX_DEFAULT_EXPIRATION') > env('MIX_MAX_EXPIRATION')) {
            throw new FatalThrowableError(new Exception('Default expiration is higher than max expiration'));
            die();
        }
    }
}
