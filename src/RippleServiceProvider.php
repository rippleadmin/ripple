<?php

namespace RippleAdmin;

use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use RippleAdmin\Exceptions\Handler as ExceptionHandler;
use RippleAdmin\Routing\RippleRouteMethods;

class RippleServiceProvider extends ServiceProvider
{
    /**
     * Register Ripple Admin service.
     *
     * @return void
     */
    public function register()
    {
        $this->registerExceptionHandler();
        $this->registerRouteMixin();
    }

    /**
     * Bootstrap Ripple Admin service.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerViews();
        $this->registerMigrations();
        $this->registerFactories();
        $this->publishFiles();
    }

    /**
     * Register the Ripple Admin exception handler.
     *
     * @return void
     */
    public function registerExceptionHandler()
    {
        $this->app->singleton(ExceptionHandlerContract::class, ExceptionHandler::class);
    }

    /**
     * Register the Ripple route mixin.
     *
     * @return void
     */
    public function registerRouteMixin()
    {
        Route::mixin(new RippleRouteMethods);
    }

    /**
     * Register the Ripple Admin views.
     *
     * @return void
     */
    public function registerViews()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'ripple-admin');
    }

    /**
     * Register the Ripple Admin migrations.
     *
     * @return void
     */
    public function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register the Ripple Admin factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        $this->loadFactoriesFrom(__DIR__.'/../database/factories');
    }

    /**
     * Publish the Ripple Admin files.
     *
     * @return void
     */
    public function publishFiles()
    {
        $this->publishes([
            __DIR__.'/../config/ripple.php' => config_path('ripple.php'),
        ], 'ripple-admin-config');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'ripple-admin-migrations');
    }
}
