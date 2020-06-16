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
            /** @var \WaterAdmin\Operation $operation */
            $operation = app($operation);

            $this->addOperation($name, $operation);

            if ($this instanceof WaterDrop) {
                $operation->setWaterDrop($this);
            }
        }

        return $this;
    }
}
