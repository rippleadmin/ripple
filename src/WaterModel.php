<?php

namespace WaterAdmin;

use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use RuntimeException;
use WaterAdmin\Concerns\HasOperations;
use WaterAdmin\Concerns\HasPages;
use WaterAdmin\WaterDrops\IndexWaterDrop;

abstract class WaterModel
{
    use Macroable,
        HasPages,
        HasOperations;

    /**
     * The original model class.
     *
     * @var string
     */
    protected $model;

    /**
     * The original model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $modelInstance;

    /**
     * The water drops instance.
     *
     * @var array
     */
    protected $waterDrops = [
        'index' => IndexWaterDrop::class,
        // 'show' => ShowWaterDrop::class,
        // 'create' => CreateWaterDrop::class,
        // 'edit' => EditWaterDrop::class,
        // 'destroy' => DestroyWaterDrop::class,
    ];

    /**
     * Create a new water model instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->bootWaterDrops();
    }

    /**
     * Get the base eloquent model instance.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function eloquent()
    {
        if (! $this->modelInstance) {
            $this->modelInstance = app($this->model);
        }

        return $this->modelInstance;
    }

    /**
     * Define the water model fields.
     *
     * @return \WaterAdmin\Field[]
     */
    abstract public function fields();

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
        $waterDrop->setWaterModel($this);

        // Set pages from water drops
        foreach ($waterDrop->pages() as $name => $page) {
            $this->addPage($name, $page);
            $page->setWaterModel($this);
        }

        // Set operations from water drops
        foreach ($waterDrop->operations() as $name => $operation) {
            $this->addOperation($name, $operation);
            $operation->setWaterModel($this);
        }

        return $this;
    }

    /**
     * Bootstrap all water drops instance.
     *
     * @return $this
     */
    public function bootWaterDrops()
    {
        foreach ($this->waterDrops as $name => $waterDrop) {
            if (method_exists(self::class, Str::camel($name))) {
                throw new RuntimeException(
                    sprintf('WaterDrop name \'%s\' is invalid.', $name)
                );
            }

            /** @var \WaterAdmin\WaterDrop $waterDrop */
            $waterDrop = app($waterDrop);

            $waterDrop->fields($this->fields());

            $this->addWaterDrop(
                $name, $this->{Str::camel($name)}($waterDrop)
            );
        }

        return $this;
    }
}
