<?php

namespace WaterAdmin\Components;

use WaterAdmin\Component;

class Aaa extends Component
{
    /**
     * Set the initial component props.
     *
     * @return array
     */
    public function props()
    {
        return [
            'bbb' => Bbb::make(),
        ];
    }
}
