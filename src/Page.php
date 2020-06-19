<?php

namespace WaterAdmin;

use Illuminate\Support\Traits\Macroable;
use WaterAdmin\Concerns\HasWaterDrop;
use WaterAdmin\Concerns\HasWaterModel;

class Page extends PlainPage
{
    use Macroable,
        HasWaterModel,
        HasWaterDrop;

    /**
     * Get this page fields.
     *
     * @return array
     */
    public function getFields()
    {
        return $this->waterDrop->getFields();
    }
}
