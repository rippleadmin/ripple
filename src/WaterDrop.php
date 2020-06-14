<?php

namespace WaterAdmin;

use WaterAdmin\Concerns\HasOperations;
use WaterAdmin\Concerns\HasPages;

class WaterDrop
{
    use HasPages,
        HasOperations;

    /**
     * Create a new water drop instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->bootPages();
        $this->bootOperations();
    }
}
