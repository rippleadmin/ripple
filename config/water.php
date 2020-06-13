<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Water Admin Domain
    |--------------------------------------------------------------------------
    |
    | This is the subdomain where Water Admin will be accessible from. If this
    | setting is null, Water Admin will reside under the same domain as the
    | application. Otherwise, this value will serve as the subdomain.
    |
    */

    'domain' => null,

    /*
    |--------------------------------------------------------------------------
    | Water Admin Prefix
    |--------------------------------------------------------------------------
    |
    | This is the URI prefix where Water Admin will be accessible from. Feel
    | free to change this prefix to anything you like. Note that the URI will
    | not affect the paths of its internal API that aren't exposed to users.
    |
    */

    'prefix' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Water Admin Controller Namespace
    |--------------------------------------------------------------------------
    |
    | This value is the controller namespace of Water Admin.
    |
    */

    'controller' => '\App\Water\Controllers',

    /*
    |--------------------------------------------------------------------------
    | Water Admin Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will get attached onto each Water Admin route, giving
    | you the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => [
        'web',
        \WaterAdmin\WaterAdmin\Middleware\InertiaRequest::class,
    ],

];
