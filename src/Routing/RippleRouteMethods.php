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
}
