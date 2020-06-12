<?php

namespace WaterAdmin\WaterAdmin;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use WaterAdmin\WaterAdmin\Middleware\InertiaRequest;

class WaterApplicationServiceProvider extends ServiceProvider
{
    /**
     * Register Water Admin service.
     *
     * @return void
     */
    public function register()
    {
        //
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
        $this->registerAssets();
    }

    /**
     * Register the Water Admin routes.
     *
     * @return void
     */
    public function registerRoutes()
    {
        Route::domain(null)
            ->prefix('admin')
            ->middleware(['web', InertiaRequest::class])
            ->namespace('\App\Water\Controllers')
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
     * Register the Water Admin base assets.
     *
     * @return void
     */
    public function registerAssets()
    {
        Water::mainAsset('water-admin.js', public_path('vendor/water-admin/js/water-admin.js'));
        Water::mainAsset('water-admin-main.js', public_path('vendor/water-admin/js/main.js'));
    }
}
