<?php

namespace WaterAdmin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use WaterAdmin\Concerns\HasOperations;
use WaterAdmin\Concerns\HasPages;
use WaterAdmin\Concerns\HasWaterModel;
use WaterAdmin\Fields\Concerns\FieldsValues;

abstract class WaterDrop
{
    use Macroable,
        HasWaterModel,
        HasPages,
        HasOperations,
        FieldsValues;

    /**
     * The model key name.
     *
     * @var string
     */
    protected $modelKey = 'id';

    /**
     * The model key value.
     *
     * @var string
     */
    protected $modelKeyValue;

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

    /**
     * Get the eloquent model.
     *
     * @param  string|null  $key
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function getModel(string $key = null)
    {
        return $this->eloquent()
            ->query()
            ->where($key ?? $this->getModelKey(), $this->getModelKeyValue())
            ->first();
    }

    /**
     * Get all eloquent models.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model[]
     */
    public function getModels()
    {
        // Auto eager load relationships
        $eagerLoadFields = array_filter($this->fields, function (Field $field) {
            return strpos($field->key(), '.') !== false;
        });

        $eagerLoadFields = array_map(function (Field $field) {
            return Str::beforeLast($field->key(), '.');
        }, $eagerLoadFields);

        return $this->eloquent()->with($eagerLoadFields)->get();
    }

    /**
     * Get the model key name.
     *
     * @return void
     */
    public function getModelKey()
    {
        return $this->modelKey;
    }

    /**
     * Get the model key value.
     *
     * @return void
     */
    public function getModelKeyValue()
    {
        return $this->modelKeyValue;
    }

    /**
     * Get the model attribute using "dot" notation.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @return mixed
     */
    public function getModelAttribute(Model $model, string $key)
    {
        $attribute = $model->getAttribute(Str::before($key, '.'));

        if ($attribute instanceof Model) {
            return $this->getModelAttribute($attribute, Str::after($key, '.'));
        }

        return $attribute;
    }
}
