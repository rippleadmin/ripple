<?php

namespace RippleAdmin\Contracts\Field;

use Illuminate\Database\Eloquent\Model;

interface Editable
{
    /**
     * Render the editable field component.
     *
     * @param  mixed  $value
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return string|\RippleAdmin\Component
     */
    public function renderEditable($value, Model $model);
}
