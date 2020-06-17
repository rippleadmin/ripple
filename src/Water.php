<?php

namespace WaterAdmin;

use Illuminate\Support\Facades\Route;

class Water
{
    /**
     * The CSS assets include to Water Admin.
     *
     * @var \WaterAdmin\Asset[]
     */
    public static $css = [];

    /**
     * The JS assets include to Water Admin.
     *
     * @var \WaterAdmin\Asset[]
     */
    public static $js = [];

    /**
     * The assets for Water Admin.
     *
     * @var \WaterAdmin\Asset[]
     */
    public static $assets = [];

    /**
     * The Water Admin routes file path.
     *
     * @var array
     */
    public static $routesPath;

    /**
     * The Water Admin plugin routes file path.
     *
     * @var array
     */
    public static $pluginRoutesPath = [];

    /**
     * Define the "water" routes for the application.
     *
     * @return void
     */
    public static function routes()
    {
        Route::namespace('\WaterAdmin\Controllers')
            ->group(__DIR__.'/../routes/water.php');

        foreach (static::$pluginRoutesPath as $path) {
            Route::group([], $path);
        }
    }

    /**
     * Register the routes file path.
     *
     * @param  string  $path
     * @return static
     */
    public static function setRoutesPath(string $path)
    {
        static::$routesPath = $path;

        return new static;
    }

    /**
     * Get the routes file path.
     *
     * @return string
     */
    public static function getRoutesPath()
    {
        return static::$routesPath ?? base_path('routes/water.php');
    }

    /**
     * Register the plugin routes file path.
     *
     * @param  string  $path
     * @return static
     */
    public static function pluginRoutes(string $path)
    {
        static::$pluginRoutesPath[] = $path;

        return new static;
    }

    /**
     * Add the CSS files include to Water Admin.
     *
     * @param  string  $path
     * @param  string  $manifestDirectory
     * @return static
     */
    public static function css(string $path, string $manifestDirectory = '')
    {
        static::$css[] = new Asset($path, $manifestDirectory);

        return new static;
    }

    /**
     * Add the JS files include to Water Admin.
     *
     * @param  string  $path
     * @param  string  $manifestDirectory
     * @return static
     */
    public static function js(string $path, string $manifestDirectory = '')
    {
        static::$js[] = new Asset($path, $manifestDirectory);

        return new static;
    }

    /**
     * Add the asset to Water Admin.
     *
     * @param  string  $path
     * @param  string  $manifestDirectory
     * @return static
     */
    public static function asset(string $path, string $manifestDirectory = '')
    {
        static::$assets[] = new Asset($path, $manifestDirectory);

        return new static;
    }

    /**
     * Get the Water Admin styles assets instance.
     *
     * @return array
     */
    public static function styles()
    {
        return static::$css;
    }

    /**
     * Get the Water Admin scripts assets instance.
     *
     * @return array
     */
    public static function scripts()
    {
        return static::$js;
    }

    /**
     * Get the Water Admin asset instance.
     *
     * @param  string  $path
     * @return \WaterAdmin\Asset|null
     */
    protected function getAsset(string $path)
    {
        return array_merge(
            static::$assets,
            static::$css,
            static::$js
        )[$path] ?? null;
    }
}
