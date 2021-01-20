<?php

namespace RippleAdmin\Routing;

use RippleAdmin\Droplet;
use RippleAdmin\Water;

class RippleRouteMethods
{
    /**
     * Register the routes of water model.
     *
     * @param  string  $prefix
     * @param  string|\RippleAdmin\Water  $water
     * @return callable
     */
    public function water()
    {
        return function (string $prefix, $water) {
            if (! $water instanceof Water) {
                $water = $this->container->make($water);
            }

            $water->registerRoute($this, $prefix);
        };
    }

    /**
     * Register the routes of droplet.
     *
     * @param  string|\RippleAdmin\Droplet  $droplet
     * @return callable
     */
    public function droplet()
    {
        return function ($droplet) {
            if (! $droplet instanceof Droplet) {
                $droplet = $this->container->make($droplet);
            }

            $droplet->routes($this);
        };
    }
}
