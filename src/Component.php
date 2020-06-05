<?php

namespace WaterAdmin\WaterAdmin;

use JsonSerializable;
use WaterAdmin\WaterAdmin\Contracts\InertiaRenderable;

abstract class Component implements JsonSerializable, InertiaRenderable
{
    /**
     * The component name.
     *
     * @var string
     */
    protected $name;

    /**
     * The component props.
     *
     * @var array
     */
    protected $props = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->props = $this->props();
    }

    /**
     * Make a new component instance.
     *
     * @return $this
     */
    public static function make()
    {
        return new static(...func_get_args());
    }

    /**
     * Get the component name.
     *
     * @return string
     */
    public function getName()
    {
        if ($this->name) {
            return $this->name;
        }

        return class_basename($this);
    }

    /**
     * Set the initial component props.
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable
     */
    public function props()
    {
        return [];
    }

    /**
     * Get the component props.
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable
     */
    public function getProps()
    {
        return $this->props;
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->getName(),
            'props' => $this->getProps(),
        ];
    }

    /**
     * Get value in serialized by json encode().
     *
     * @return array
     */
    public function jsonSerialize() {
        return $this->toArray();
    }
}
