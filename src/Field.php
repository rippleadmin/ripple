<?php

namespace WaterAdmin;

use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;

abstract class Field
{
    use Macroable;

    /**
     * The field key.
     *
     * @var string
     */
    protected $key;

    /**
     * The field display text.
     *
     * @var string
     */
    protected $label;

    /**
     * Create a new field instance.
     *
     * @param  string  $key
     * @param  string|null  $label
     * @return void
     */
    public function __construct(string $key, string $label = null)
    {
        $this->key = $key;
        $this->setLabel($label);
    }

    /**
     * Make a new field instance.
     *
     * @return $this
     */
    public static function make()
    {
        return new static(...func_get_args());
    }

    /**
     * Get the field key.
     *
     * @return string
     */
    public function key()
    {
        return $this->key;
    }

    /**
     * Set the field key.
     *
     * @param  string  $key
     * @return $this
     */
    public function setKey(string $key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get the field display text.
     *
     * @return string
     */
    public function label()
    {
        return $this->label;
    }

    /**
     * Set the field display text.
     *
     * @param  string|null  $label
     * @return $this
     */
    public function setLabel(string $label = null)
    {
        $this->label = $label ?? ucfirst(preg_replace('/[_\.]/', ' ', Str::snake($this->key)));

        return $this;
    }
}
