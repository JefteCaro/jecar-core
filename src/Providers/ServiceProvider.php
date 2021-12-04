<?php

namespace Jecar\Core\Providers;

use Illuminate\Support\ServiceProvider as BaseProvider;
use Jecar\Core\Console\Commands\PublishMigrations;
use Jecar\Core\Console\Commands\PublishViews;
use Jecar\Core\Services\MediaFileService;

class ServiceProvider extends BaseProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('jecar-media', function($app) {
            return new MediaFileService;
        });

        $this->publishables();

        $this->commands([
            PublishMigrations::class,
            PublishViews::class,
        ]);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function publishables()
    {
        $this->publishes([
            $this->resourcePath('config/jecar.php') => \config_path('jecar.php')
        ], 'jecar.config');

    }

    public function resourcePath(string $res)
    {
        return __DIR__ . '../../../resources/' . $res;
    }
}
