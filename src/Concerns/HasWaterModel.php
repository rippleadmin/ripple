<?php

namespace WaterAdmin\Concerns;

use WaterAdmin\WaterModel;

trait HasWaterModel
{
    /**
     * The water model instance.
     *
     * @var \WaterAdmin\WaterModel
     */
    protected $waterModel;

    /**
     * Get the water model instance.
     *
     * @return \WaterAdmin\WaterModel
     */
    public function waterModel()
    {
        return $this->waterModel;
    }

    /**
     * Set the water model instance.
     *
     * @param  \WaterAdmin\WaterModel  $waterModel
     * @return $this
     */
    public function setWaterModel(WaterModel $waterModel)
    {
        $this->waterModel = $waterModel;

        return $this;
    }

    /**
     * Get the base eloquent model instance.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function eloquent()
    {
        return $this->waterModel->eloquent();
    }
}
