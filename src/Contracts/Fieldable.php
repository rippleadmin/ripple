<?php

namespace WaterAdmin\Contracts;

interface Fieldable
{
    /**
     * Get the instance fields.
     *
     * @return \WaterAdmin\Form\Fields\Field[]
     */
    public function toFields();
}
