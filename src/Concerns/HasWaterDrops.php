<?php

namespace WaterAdmin\Concerns;

use WaterAdmin\WaterDrop;
use WaterAdmin\WaterDrops\ListWaterDrop;

trait HasWaterDrops
{
    use HasPages,
        HasOperations;

    /**
     * The water drops instance.
     *
     * @var array
     */
    protected $waterDrops = [
        'list' => ListWaterDrop::class,
        // 'show' => ShowWaterDrop::class,
        // 'create' => CreateWaterDrop::class,
        // 'edit' => EditWaterDrop::class,
        // 'destroy' => DestroyWaterDrop::class,
    ];

    /**
     * Get all water drops instance.
     *
     * @return array
     */
    public function waterDrops()
    {
        return $this->waterDrops;
    }

    /**
     * Get the water drop instance.
     *
     * @param  string  $name
     * @return \WaterAdmin\WaterDrop
     */
    public function waterDrop(string $name)
    {
        return $this->waterDrops[$name];
    }

    /**
     * Add a new water drop instance.
     *
     * @param  string  $name
     * @param  string|\WaterAdmin\WaterDrop  $waterDrop
     * @return $this
     */
    public function addWaterDrop(string $name, WaterDrop $waterDrop)
    {
        $this->waterDrops[$name] = $waterDrop;

        foreach ($waterDrop->pages() as $name => $page) {
            $this->addPage($name, $page);
        }

        foreach ($waterDrop->operations() as $name => $operation) {
            $this->addOperation($name, $operation);
        }
    }

    /**
     * Bootstrap all water drops instance.
     *
     * @return $this
     */
    public function bootWaterDrops()
    {
        foreach ($this->waterDrops as $name => $waterDrop) {
            $this->addWaterDrop($name, app($waterDrop));
        }

        return $this;
    }
}
