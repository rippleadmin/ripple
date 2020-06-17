<?php

use WaterAdmin\Routing\Redirector;

if (! function_exists('class_basename')) {
    /**
     * Get the class "basename" of the given object / class.
     *
     * @param  string|object  $class
     * @return string
     */
    function class_basename($class)
    {
        $class = is_object($class) ? get_class($class) : $class;

        return basename(str_replace('\\', '/', $class));
    }
}

if (! function_exists('water_url')) {
    /**
     * Generate a url for the Water Admin.
     *
     * @param  string  $path
     * @param  mixed  $parameters
     * @param  bool|null  $secure
     * @return string
     */
    function water_url($path, $parameters = [], $secure = null)
    {
        return url(config('water.prefix').'/'.ltrim($path, '/'), $parameters, $secure);
    }
}

if (! function_exists('water_redirect')) {
    /**
     * Get an instance of the redirector for Water Admin.
     *
     * @param  string|null  $to
     * @param  int  $status
     * @param  array  $headers
     * @param  bool|null  $secure
     * @return \WaterAdmin\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    function water_redirect($to = null, $status = 302, $headers = [], $secure = null)
    {
        if (is_null($to)) {
            return app(Redirector::class);
        }

        return app(Redirector::class)->to($to, $status, $headers, $secure);
    }
}
