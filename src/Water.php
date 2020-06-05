<?php

namespace WaterAdmin\WaterAdmin;

use Illuminate\Support\Facades\Route;

class Water
{
    /**
     * The CSS files include to Water Admin.
     *
     * @var array
     */
    public static $css = [];

    /**
     * The JS files include to Water Admin.
     *
     * @var array
     */
    public static $js = [];

    /**
     * Define the "water" routes for the application.
     *
     * @return void
     */
    public static function routes()
    {
        Route::namespace('\WaterAdmin\WaterAdmin\Http\Controllers')
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
}
