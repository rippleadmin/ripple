<?php

namespace WaterAdmin\Concerns;

use WaterAdmin\WaterDrop;

trait HasWaterDrop
{
    /**
     * The water drop instance.
     *
     * @var \WaterAdmin\WaterDrop
     */
    protected $waterDrop;

    /**
     * Get the water drop instance.
     *
     * @return \WaterAdmin\WaterDrop
     */
    public function waterDrop()
    {
        return $this->waterDrop;
    }

    /**
     * Set the water drop instance.
     *
     * @param  \WaterAdmin\WaterDrop  $waterDrop
     * @return $this
     */
    public function setWaterDrop(WaterDrop $waterDrop)
    {
        $this->waterDrop = $waterDrop;

        return $this;
    }
}
