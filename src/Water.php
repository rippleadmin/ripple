<?php

namespace WaterAdmin\WaterAdmin;

use Illuminate\Support\Facades\Route;

class Water
{
    /**
     * The CSS files include to Water Admin.
     *
     * @var string[]
     */
    public static $css = [];

    /**
     * The JS files include to Water Admin.
     *
     * @var string[]
     */
    public static $js = [];

    /**
     * The main assets for Water Admin.
     *
     * @var string[]
     */
    public static $mainAssets = [];

    /**
     * Define the "water" routes for the application.
     *
     * @return void
     */
    public static function routes()
    {
        Route::namespace('\WaterAdmin\WaterAdmin\Controllers')
            ->group(__DIR__.'/../routes/water.php');
    }

    /**
     * Add the CSS files include to Water Admin.
     *
     * @param  string  $name
     * @param  string  $path
     * @return static
     */
    public static function css(string $name, string $path)
    {
        static::$css[$name] = $path;

        return new static;
    }

    /**
     * Add the JS files include to Water Admin.
     *
     * @param  string  $name
     * @param  string  $path
     * @return static
     */
    public static function js(string $name, string $path)
    {
        static::$js[$name] = $path;

        return new static;
    }

    /**
     * Add the main assets to Water Admin.
     *
     * @param  string  $name
     * @param  string  $path
     * @return static
     */
    public static function mainAsset(string $name, string $path)
    {
        static::$mainAssets[$name] = $path;

        return new static;
    }
}
