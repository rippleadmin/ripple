<?php

namespace WaterAdmin\Concerns;

use WaterAdmin\Operation;
use WaterAdmin\WaterDrop;
use WaterAdmin\WaterModel;

trait HasOperations
{
    /**
     * The operations instance.
     *
     * @var array
     */
    protected $operations = [];

    /**
     * Get all operations instance.
     *
     * @return array
     */
    public function operations()
    {
        return $this->operations;
    }

    /**
     * Get the operation instance.
     *
     * @param  string  $name
     * @return \WaterAdmin\Operation
     */
    public function operation(string $name)
    {
        return $this->operations[$name];
    }

    /**
     * Add a new operation instance.
     *
     * @param  string  $name
     * @param  \WaterAdmin\Operation  $operation
     * @return $this
     */
    public function addOperation(string $name, Operation $operation)
    {
        if ($this instanceof WaterModel) {
            $operation->setWaterModel($this);
        } elseif ($this instanceof WaterDrop) {
            $operation->setWaterDrop($this);
        }

        $this->operations[$name] = $operation;

        return $this;
    }

    /**
     * Bootstrap all operations instance.
     *
     * @return $this
     */
    public function bootOperations()
    {
        foreach ($this->operations as $name => $operation) {
            $this->addOperation($name, app($operation));
        }

        return $this;
    }
}
