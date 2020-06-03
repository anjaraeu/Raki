<?php

namespace App\Providers;

use App\Group;
use App\Observers\GroupObserver;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\ErrorHandler\Error\FatalError;

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
     * @throws FatalError
     */
    public function boot()
    {
        Group::observe(GroupObserver::class);
        if (env('MIX_DEFAULT_EXPIRATION') > env('MIX_MAX_EXPIRATION')) {
            throw new FatalError('Default expiration is higher than max expiration', 500, [new \Error('.env error')]);
        }
    }
}
