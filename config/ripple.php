<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Ripple Admin Name
    |--------------------------------------------------------------------------
    |
    | This is the Ripple Admin main title.
    |
    */

    'name' => 'Ripple Admin',

    /*
    |--------------------------------------------------------------------------
    | Ripple Admin Domain
    |--------------------------------------------------------------------------
    |
    | This is the subdomain where Ripple Admin will be accessible from. If this
    | setting is null, Ripple Admin will reside under the same domain as the
    | application. Otherwise, this value will serve as the subdomain.
    |
    */

    'domain' => null,

    /*
    |--------------------------------------------------------------------------
    | Ripple Admin Prefix
    |--------------------------------------------------------------------------
    |
    | This is the URI prefix where Ripple Admin will be accessible from. Feel
    | free to change this prefix to anything you like. Note that the URI will
    | not affect the paths of its internal API that aren't exposed to users.
    |
    */

    'prefix' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Ripple Admin Controller Namespace
    |--------------------------------------------------------------------------
    |
    | This is the controller namespace of Ripple Admin.
    |
    */

    'controller' => '\Admin\Controllers',

    /*
    |--------------------------------------------------------------------------
    | Ripple Admin Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will get attached onto each Ripple Admin route, giving
    | you the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => [
        'web',
        \RippleAdmin\Http\Middleware\InertiaRequest::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Ripple Admin Authentication
    |--------------------------------------------------------------------------
    |
    | This is define the Ripple Admin authentication config. More reference
    | the Laravel auth config.
    |
    */

    'auth' => [
        'guard' => 'ripple',

        'guards' => [
            'ripple' => [
                'driver' => 'session',
                'provider' => 'ripple_users',
            ],
        ],

        'providers' => [
            'ripple_users' => [
                'driver' => 'eloquent',
                'model' => \RippleAdmin\Models\User::class,
            ],
        ],
    ],

];
