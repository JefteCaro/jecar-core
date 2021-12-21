<?php

namespace Jecar\Core\Providers;

use Illuminate\Support\ServiceProvider as BaseProvider;
use Jecar\Core\Console\Commands\PublishMigrations;
use Jecar\Core\Console\Commands\PublishViews;
use Jecar\Core\Services\JecarService;
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
        $this->app->singleton('jecar', function($app) {
            return new JecarService;
        });

        $this->loadViewsFrom(
            $this->viewGroups(), 'jecar'
        );

        $this->publishables();

        $this->commands([
            PublishMigrations::class,
            PublishViews::class,
        ]);

    }

    public function viewGroups()
    {
        if(file_exists(resource_path('views/vendor/cms/app.blade.php'))) {
            return resource_path('views/vendor/cms');
        }
        return  $this->resourcePath('views');
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
