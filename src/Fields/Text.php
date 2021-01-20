<?php

namespace RippleAdmin\Fields;

use Illuminate\Database\Eloquent\Model;
use RippleAdmin\Fields\Concerns\DisplayableField;
use RippleAdmin\Fields\Concerns\EditableField;
use RippleAdmin\Contracts\Field\Displayable;
use RippleAdmin\Contracts\Field\Editable;
use RippleAdmin\Field;

class Text extends Field implements Displayable, Editable
{
    use DisplayableField,
        EditableField;

    /**
     * Render the displayable field component.
     *
     * @param  mixed  $value
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return string|\RippleAdmin\Component
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
     * @return string|\RippleAdmin\Component
     */
    public function renderEditable($value, Model $model)
    {
        return $value;
    }
}
