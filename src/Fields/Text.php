<?php

namespace WaterAdmin\Fields;

use Illuminate\Database\Eloquent\Model;
use WaterAdmin\Fields\Concerns\DisplayableField;
use WaterAdmin\Fields\Concerns\EditableField;
use WaterAdmin\Contracts\Field\Displayable;
use WaterAdmin\Contracts\Field\Editable;
use WaterAdmin\Field;

class Text extends Field implements Displayable, Editable
{
    use DisplayableField,
        EditableField;

    /**
     * Render the displayable field component.
     *
     * @param  mixed  $value
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return string|\WaterAdmin\Component
     */
    public function renderDisplayable($value, Model $model)
    {
        return $value;
    }

    /**
     * Render the editable field component.
     *
     * @param  mixed  $value
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return string|\WaterAdmin\Component
     */
    public function renderEditable($value, Model $model)
    {
        return $value;
    }
}
