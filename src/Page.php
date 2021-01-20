<?php

namespace RippleAdmin;

use Illuminate\Support\Traits\Macroable;
use RippleAdmin\Concerns\HasDroplet;
use RippleAdmin\Concerns\HasWater;

class Page extends PlainPage
{
    use Macroable,
        HasWater,
        HasDroplet;

    /**
     * Get the page props.
     *
     * @return array
     */
    public function pageProps()
    {
        return [
            //
        ];
    }

    /**
     * Get the page all props.
     *
     * @return array
     */
    public function props()
    {
        return array_merge(parent::props(), $this->pageProps());
    }

    /**
     * Get this page fields.
     *
     * @return array
     */
    public function getFields()
    {
        return $this->droplet->getFields();
    }
}
