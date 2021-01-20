<?php

namespace RippleAdmin;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use RippleAdmin\Component;
use RippleAdmin\Http\Middleware\Authenticate;
use RippleAdmin\Http\Middleware\RedirectIfAuthenticated;
use RippleAdmin\Routing\Redirector;

class RippleApplicationServiceProvider extends ServiceProvider
{
    /**
     * Register Ripple Admin service.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRedirector();
        $this->registerConfig();
        $this->registerClassesNamespacesPrefix();
    }

    /**
     * Bootstrap Ripple Admin service.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMiddlewares();
        $this->registerRoutes();
        $this->addZiggyConfig();
    }

    /**
     * Register the Redirector service.
     *
     * @return void
     */
    protected function registerRedirector()
    {
        $this->app->singleton('ripple.redirect', function ($app) {
            $redirector = new Redirector($app['url']);

            if (isset($app['session.store'])) {
                $redirector->setSession($app['session.store']);
            }

            return $redirector;
        });
    }

    /**
     * Register the Ripple Admin config.
     *
     * @return void
     */
    public function registerConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ripple.php', 'ripple');

        // Merge auth guards and auth providers to Laravel config
        $this->app['config']['auth.guards'] = array_merge(
            $this->app['config']['auth.guards'],
            $this->app['config']['ripple.auth.guards']
        );
        $this->app['config']['auth.providers'] = array_merge(
            $this->app['config']['auth.providers'],
            $this->app['config']['ripple.auth.providers']
        );
    }

    /**
     * Add the Ripple Admin route config to Ziggy.
     *
     * @return void
     */
    public function addZiggyConfig()
    {
        $this->app['config']['ziggy.blacklist'] = collect($this->app['config']['ziggy.blacklist'])
            ->concat(['debugbar.*', 'horizon.*', 'ignition.*', 'ripple.*'])
            ->unique()
            ->all();
        $this->app['config']['ziggy.groups.ripple'] = ['ripple.*'];
    }

    /**
     * Publish the Ripple Admin classes namespaces prefix.
     *
     * @return void
     */
    public function registerClassesNamespacesPrefix()
    {
        Component::namespace('RippleAdmin\Components');
    }

    /**
     * Register the Ripple Admin middlewares.
     *
     * @return void
     */
    public function registerMiddlewares()
    {
        $this->app['router']->aliasMiddleware('ripple.auth', Authenticate::class);
        $this->app['router']->aliasMiddleware('ripple.guest', RedirectIfAuthenticated::class);
    }

    /**
     * Register the Ripple Admin routes.
     *
     * @return void
     */
    public function registerRoutes()
    {
        Route::domain(config('ripple.domain'))
            ->prefix(config('ripple.prefix'))
            ->middleware(config('ripple.middleware'))
            ->namespace(config('ripple.controller'))
            ->group(base_path('admin/routes.php'));
    }
}
