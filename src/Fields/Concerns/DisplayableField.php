<?php

namespace WaterAdmin\Fields\Concerns;

trait DisplayableField
{
    /**
     * The render displayable field component callable.
     *
     * @var array
     */
    protected $renderDisplayable;

    /**
     * Set the render displayable field component callable.
     *
     * @param  callable  $callback
     * @return $this
     */
    public function setRenderDisplayable(callable $callback)
    {
        $this->renderDisplayable = $callback;

        return $this;
    }

    /**
     * Call the render displayable field component callable.
     *
     * @param  mixed  $value
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return string|\WaterAdmin\Component
     */
    public function callRenderDisplayable($value, Model $model)
    {
        if ($this->renderDisplayable) {
            return call_user_func($this->renderDisplayable, $value, $model);
        }

        return $this->renderDisplayable();
    }
}
