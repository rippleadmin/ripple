<?php

namespace RippleAdmin;

use Illuminate\Support\Facades\Route;

class Ripple
{
    /**
     * The CSS assets include to Ripple Admin.
     *
     * @var \RippleAdmin\Asset[]
     */
    public static $css = [];

    /**
     * The JS assets include to Ripple Admin.
     *
     * @var \RippleAdmin\Asset[]
     */
    public static $js = [];

    /**
     * The assets for Ripple Admin.
     *
     * @var \RippleAdmin\Asset[]
     */
    public static $assets = [];

    /**
     * The Ripple Admin plugin routes path.
     *
     * @var array
     */
    public static $pluginRoutesPath = [];

    /**
     * Define the "ripple" routes for the application.
     *
     * @return void
     */
    public static function routes()
    {
        Route::namespace('\RippleAdmin\Http\Controllers')
            ->group(__DIR__.'/../routes/ripple.php');

        foreach (static::$pluginRoutesPath as $path) {
            Route::group([], $path);
        }
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
     * Add the CSS files include to Ripple Admin.
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
     * Add the JS files include to Ripple Admin.
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
     * Add the asset to Ripple Admin.
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
     * Get the Ripple Admin styles assets instance.
     *
     * @return array
     */
    public static function styles()
    {
        return static::$css;
    }

    /**
     * Get the Ripple Admin scripts assets instance.
     *
     * @return array
     */
    public static function scripts()
    {
        return static::$js;
    }

    /**
     * Get the Ripple Admin asset instance.
     *
     * @param  string  $path
     * @return \RippleAdmin\Asset|null
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
