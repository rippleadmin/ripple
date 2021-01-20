<?php

namespace RippleAdmin\Concerns;

use RippleAdmin\Droplet;

trait HasDroplet
{
    /**
     * The droplet instance.
     *
     * @var \RippleAdmin\Droplet
     */
    protected $droplet;

    /**
     * Get the droplet instance.
     *
     * @return \RippleAdmin\Droplet
     */
    public function droplet()
    {
        return $this->droplet;
    }

    /**
     * Set the droplet instance.
     *
     * @param  \RippleAdmin\Droplet  $droplet
     * @return $this
     */
    public function setDroplet(Droplet $droplet)
    {
        $this->droplet = $droplet;

        return $this;
    }
}
