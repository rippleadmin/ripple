<?php

namespace WaterAdmin\WaterAdmin\Components;

use WaterAdmin\WaterAdmin\Component;

class Aaa extends Component
{
    /**
     * Set the initial component props.
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable
     */
    public function props()
    {
        return [
            'bbb' => Bbb::make(),
        ];
    }
}
