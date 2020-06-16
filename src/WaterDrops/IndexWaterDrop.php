<?php

namespace WaterAdmin\WaterDrops;

use WaterAdmin\Pages\TablePage;
use WaterAdmin\WaterDrop;

class IndexWaterDrop extends WaterDrop
{
    /**
     * The pages instance.
     *
     * @var array
     */
    protected $pages = [
        'index' => TablePage::class,
    ];
}
