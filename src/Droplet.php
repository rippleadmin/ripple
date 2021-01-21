<?php

namespace RippleAdmin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Router;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use RippleAdmin\Concerns\HasActions;
use RippleAdmin\Concerns\HasPages;
use RippleAdmin\Concerns\HasWater;
use RippleAdmin\Contracts\Field\Displayable;
use RippleAdmin\Fields\Concerns\FieldsValues;

abstract class Droplet
{
    use Macroable,
        HasWater,
        HasPages,
        HasActions,
        FieldsValues;

    /**
     * Allows export methods of droplets.
     *
     * @var string[]
     */
    public $methods = [];

    /** @var \Illuminate\Database\Eloquent\Model */
    protected $model;
    protected $modelKeyName = 'id';

    protected $perPage = 10;
    protected $pagination = false;

    public function __construct(Water $water)
    {
        $this->water = $water;
    }

    /**
     * Define the routes of the droplet.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    abstract protected function routes(Router $router);

    /**
     * Set & get the eloquent model.
     *
     * @param  string|\Illuminate\Database\Eloquent\Model|null  $model
     * @param  string|null  $field
     * @return $this
     */
    public function model($model = null, string $field = null)
    {
        if (! is_null($model)) {
            if (! $model instanceof Model) {
                $model = $this->eloquent()
                    ->query()
                    ->where($field ?? $this->getModelKeyName(), $model)
                    ->first();
            }

            $this->model = $model;
        }

        return $this->model;
    }

    /**
     * Get all eloquent models.
     *
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function models()
    {
        $query = $this->eloquent()
            ->with($this->eagerLoadFields());

        return $this->pagination
            ? $query->paginate($this->perPage)
            : $query->get();
    }

    /**
     * Get the model key name.
     *
     * @return string
     */
    public function getModelKeyName()
    {
        return $this->modelKeyName;
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

    /**
     * Get the auto eager load relationships.
     *
     * @return \RippleAdmin\Field[]
     */
    public function eagerLoadFields()
    {
        $eagerLoadFields = array_filter($this->fields, function (Field $field) {
            return Str::contains($field->key(), '.');
        });

        return array_map(function (Field $field) {
            return Str::beforeLast($field->key(), '.');
        }, $eagerLoadFields);
    }

    /**
     * Transform the resource / collection data with fields.
     *
     * @param  callable  $callback
     * @return array
     */
    public function transform(callable $callback)
    {
        return $this->model
            ? $this->transformResource($this->model(), $callback)
            : $this->transformCollection($this->models(), $callback);
    }

    /**
     * Build the model / models data.
     *
     * @return array
     */
    public function buildModelData()
    {
        return $this->transform(function (Model $model, Field $field) {
            if ($field instanceof Displayable) {
                return [$field->key() => $field->renderDisplayable(
                    $this->getModelAttribute($model, $field->key()), $model
                )];
            }

            return [];
        });
    }
}
