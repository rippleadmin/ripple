<?php

namespace WaterAdmin;

use WaterAdmin\Concerns\HasWaterDrops;

abstract class WaterModel
{
    use HasWaterDrops;

    /**
     * The original model class.
     *
     * @var string
     */
    protected $model;

    /**
     * The original model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $modelInstance;

    /**
     * Create a new water model instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->bootWaterDrops();
    }

    /**
     * Get the original model instance.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function model()
    {
        if (! $this->modelInstance) {
            $this->modelInstance = app($this->model);
        }

        return $this->modelInstance;
    }

    /**
     * The fields for water model.
     *
     * @return array
     */
    abstract public function fields();
}
