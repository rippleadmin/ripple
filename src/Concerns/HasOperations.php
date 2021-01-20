<?php

namespace RippleAdmin\Concerns;

use RippleAdmin\Operation;
use RippleAdmin\Droplet;

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
     * @return \RippleAdmin\Operation
     */
    public function operation(string $name)
    {
        return $this->operations[$name];
    }

    /**
     * Add a new operation instance.
     *
     * @param  string  $name
     * @param  \RippleAdmin\Operation  $operation
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
            /** @var \RippleAdmin\Operation $operation */
            $operation = app($operation);

            $this->addOperation($name, $operation);

            if ($this instanceof Droplet) {
                $operation->setDroplet($this);
            }
        }

        return $this;
    }
}
