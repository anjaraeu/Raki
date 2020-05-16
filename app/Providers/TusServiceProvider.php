<?php


namespace App\Providers;

use App\Http\Controllers\TusController;
use Illuminate\Support\Facades\Log;
use TusPhp\Events\TusEvent;
use TusPhp\Tus\Server as TusServer;
use Illuminate\Support\ServiceProvider;

class TusServerBoosted extends TusServer {
    public function setCachePrefix(string $prefix) {
        $this->cache->setPrefix($prefix);
        return $this;
    }
}

class TusServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('tus-server', function ($app) {

            $server = new TusServerBoosted('redis');

            $server
                ->setApiPath('/tus') // tus server endpoint.
                ->setUploadDir(storage_path('app/tus_files')); // uploads dir.

            $server->setCachePrefix(config('database.redis.options.prefix').'tus:');

            $server->event()->addListener('tus-server.upload.complete', function (TusEvent $event) {
                $controller = new TusController();
                $controller->storeFile($event->getFile());
            });

            return $server;
        });
    }
}
