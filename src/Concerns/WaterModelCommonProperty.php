<?php

namespace WaterAdmin\Concerns;

use WaterAdmin\WaterDrop;
use WaterAdmin\WaterModel;

trait WaterModelCommonProperty
{
    /**
     * The water model instance.
     *
     * @var \WaterAdmin\WaterModel
     */
    protected $waterModel;

    /**
     * The water drop instance.
     *
     * @var \WaterAdmin\WaterDrop
     */
    protected $waterDrop;

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
     * Get the original model instance.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model()
    {
        return $this->waterModel->model();
    }

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
