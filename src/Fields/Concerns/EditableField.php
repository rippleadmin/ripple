<?php

namespace RippleAdmin\Fields\Concerns;

trait EditableField
{
    /**
     * The render editable field component callable.
     *
     * @var array
     */
    protected $renderEditable;

    /**
     * Set the render editable field component callable.
     *
     * @param  callable  $callback
     * @return $this
     */
    public function setRenderEditable(callable $callback)
    {
        $this->renderEditable = $callback;

        return $this;
    }

    /**
     * Call the render editable field component callable.
     *
     * @param  mixed  $value
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return string|\RippleAdmin\Component
     */
    public function callRenderEditable($value, Model $model)
    {
        if ($this->renderEditable) {
            return call_user_func($this->renderEditable, $value, $model);
        }

        return $this->renderEditable();
    }
}
