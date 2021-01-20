<?php

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

if (! function_exists('ripple_url')) {
    /**
     * Generate a url for the Ripple Admin.
     *
     * @param  string  $path
     * @param  mixed  $parameters
     * @param  bool|null  $secure
     * @return string
     */
    function ripple_url($path, $parameters = [], $secure = null)
    {
        return url(config('ripple.prefix').'/'.ltrim($path, '/'), $parameters, $secure);
    }
}

if (! function_exists('ripple_redirect')) {
    /**
     * Get an instance of the redirector for Ripple Admin.
     *
     * @param  string|null  $to
     * @param  int  $status
     * @param  array  $headers
     * @param  bool|null  $secure
     * @return \RippleAdmin\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    function ripple_redirect($to = null, $status = 302, $headers = [], $secure = null)
    {
        if (is_null($to)) {
            return app('ripple.redirect');
        }

        return app('ripple.redirect')->to($to, $status, $headers, $secure);
    }
}
