<?php

namespace WaterAdmin;

use Illuminate\Contracts\Debug\ExceptionHandler as ExceptionHandlerContract;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use WaterAdmin\Component;
use WaterAdmin\Exceptions\Handler as ExceptionHandler;
use WaterAdmin\Middleware\Authenticate;
use WaterAdmin\Middleware\RedirectIfAuthenticated;
use WaterAdmin\Routing\Redirector;

class WaterServiceProvider extends ServiceProvider
{
    /**
     * Register Water Admin service.
     *
     * @return void
     */
    public function register()
    {
        $this->registerExceptionHandler();
        $this->registerRedirector();
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
        $this->registerMiddlewares();
        $this->registerRoutes();
        $this->registerViews();
        $this->registerMigrations();
        $this->registerFactories();
        $this->publishFiles();
    }

    /**
     * Register the Water Admin exception handler.
     *
     * @return void
     */
    public function registerExceptionHandler()
    {
        $this->app->singleton(ExceptionHandlerContract::class, ExceptionHandler::class);
    }

    /**
     * Register the Redirector service.
     *
     * @return void
     */
    protected function registerRedirector()
    {
        $this->app->singleton('water.redirect', function ($app) {
            $redirector = new Redirector($app['url']);

            if (isset($app['session.store'])) {
                $redirector->setSession($app['session.store']);
            }

            return $redirector;
        });
    }

    /**
     * Register the Water Admin config.
     *
     * @return void
     */
    public function registerConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/water.php', 'water');

        // Merge auth guards and auth providers to Laravel config
        $this->app['config']['auth.guards'] = array_merge(
            $this->app['config']['auth.guards'],
            $this->app['config']['water.auth.guards']
        );
        $this->app['config']['auth.providers'] = array_merge(
            $this->app['config']['auth.providers'],
            $this->app['config']['water.auth.providers']
        );
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
     * Register the Water Admin middlewares.
     *
     * @return void
     */
    public function registerMiddlewares()
    {
        $this->app['router']->aliasMiddleware('water.auth', Authenticate::class);
        $this->app['router']->aliasMiddleware('water.guest', RedirectIfAuthenticated::class);
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
     * Register the Water Admin migrations.
     *
     * @return void
     */
    public function registerMigrations()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register the Water Admin factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        $this->loadFactoriesFrom(__DIR__.'/../database/factories');
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

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'water-admin-migrations');
    }
}
