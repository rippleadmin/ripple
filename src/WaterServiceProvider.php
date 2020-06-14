<?php

namespace WaterAdmin;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use WaterAdmin\Component;

class WaterServiceProvider extends ServiceProvider
{
    /**
     * Register Water Admin service.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
        $this->registerClassesNamespacesPrefix();
    }

    /**
     * Bootstrap Water Admin service.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerRoutes();
        $this->registerViews();
        $this->publishFiles();
    }

    /**
     * Register the Water Admin config.
     *
     * @return void
     */
    public function registerConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/water.php', 'water');
    }

    /**
     * Publish the Water Admin classes namespaces prefix.
     *
     * @return void
     */
    public function registerClassesNamespacesPrefix()
    {
        Component::namespace('WaterAdmin\Components');
    }

    /**
     * Register the Water Admin routes.
     *
     * @return void
     */
    public function registerRoutes()
    {
        Route::domain(config('water.domain'))
            ->prefix(config('water.prefix'))
            ->middleware(config('water.middleware'))
            ->namespace(config('water.controller'))
            ->group(base_path('routes/water.php'));
    }

    /**
     * Register the Water Admin views.
     *
     * @return void
     */
    public function registerViews()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'water-admin');
    }

    /**
     * Publish the Water Admin files.
     *
     * @return void
     */
    public function publishFiles()
    {
        $this->publishes([
            __DIR__.'/../config/water.php' => config_path('water.php'),
        ], 'water-admin-config');
    }
}
