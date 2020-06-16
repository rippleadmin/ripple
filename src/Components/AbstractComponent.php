<?php

namespace WaterAdmin\Components;

use Illuminate\Support\Traits\Macroable;
use WaterAdmin\Concerns\RelativeClassName;

abstract class AbstractComponent
{
    use Macroable,
        RelativeClassName;

    /**
     * The component name.
     *
     * @var string
     */
    protected $name;

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
    public function name()
    {
        if ($this->name) {
            return $this->name;
        }

        return $this->getRelativeClassName();
    }

    /**
     * Get the component props.
     *
     * @return array
     */
    public function props()
    {
        return [];
    }
}
