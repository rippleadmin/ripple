<?php

namespace RippleAdmin\Fields\Concerns;

use AdditionApps\FlexiblePresenter\FlexiblePresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use RippleAdmin\Field;
use RippleAdmin\RippleFlexiblePresenter;

trait FieldsValues
{
    /**
     * The droplet fields.
     *
     * @var \RippleAdmin\Field[]
     */
    protected $fields = [];

    /**
     * Set the droplet fields.
     *
     * @param  \RippleAdmin\Field[]  $fields
     * @return void
     */
    public function fields(array $fields)
    {
        $fields = collect($fields)->mapWithKeys(function (Field $field) {
            return [$field->key() => $field];
        });

        $this->fields = collect($this->fields)
            ->mapWithKeys(function (Field $field) {
                return [$field->key() => $field];
            })
            ->merge($fields)
            ->values()
            ->all();

        return $this;
    }

    /**
     * Get the droplet fields.
     *
     * @return \RippleAdmin\Field[]
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Get the droplet field.
     *
     * @return \RippleAdmin\Field|null
     */
    public function field(string $name)
    {
        return Arr::first($this->fields, function (Field $field) use ($name) {
            return $field->key() === $name;
        });
    }

    /**
     * Get the fields label.
     *
     * @return array
     */
    public function getFieldsLabel()
    {
        return collect($this->fields)->map(function (Field $field) {
            return [
                'key' => $field->key(),
                'label' => $field->label(),
            ];
        })->all();
    }

    /**
     * Get the field index.
     *
     * @param  string  $fieldKey
     * @return int|false
     */
    public function getFieldIndex(string $fieldKey)
    {
        return collect($this->fields)->search(function (Field $field) use ($fieldKey) {
            return $field->key() === $fieldKey;
        });
    }

    /**
     * Set the only fields.
     *
     * @param  array|string|dynamic  $fieldKeys
     * @return $this
     */
    public function only($fieldKeys)
    {
        $only = is_array($fieldKeys) ? $fieldKeys : func_get_args();

        $this->fields = array_values(
            Arr::only($this->getFieldsDictionary($this->fields), $only)
        );

        return $this;
    }

    /**
     * Set the except fields.
     *
     * @param  array|string|dynamic  $fieldKeys
     * @return $this
     */
    public function except($fieldKeys)
    {
        $except = is_array($fieldKeys) ? $fieldKeys : func_get_args();

        $this->fields = array_values(
            Arr::except($this->getFieldsDictionary($this->fields), $except)
        );

        return $this;
    }

    /**
     * Add the field before the specified field.
     *
     * @param  string  $baseFieldKey
     * @param  \RippleAdmin\Field  $field
     * @return $this
     */
    public function before(string $baseFieldKey, Field $field)
    {
        $index = $this->getFieldIndex($baseFieldKey);

        if ($this->fields[$index]) {
            array_splice($this->fields, $index, 0, [$field]);
        }

        return $this;
    }

    /**
     * Add the field after the specified field.
     *
     * @param  string  $baseFieldKey
     * @param  \RippleAdmin\Field  $field
     * @return $this
     */
    public function after(string $baseFieldKey, Field $field)
    {
        $index = $this->getFieldIndex($baseFieldKey);

        if ($this->fields[$index]) {
            array_splice($this->fields, $index + 1, 0, [$field]);
        }

        return $this;
    }

    /**
     * Get a dictionary keyed by primary keys.
     *
     * @param  \RippleAdmin\Field[]  $items
     * @return array
     */
    public function getFieldsDictionary($fields)
    {
        $dictionary = [];

        /** @var \RippleAdmin\Field $field */
        foreach ($fields as $field) {
            $dictionary[$field->key()] = $field;
        }

        return $dictionary;
    }

    /**
     * Transform the resource data with fields.
     *
     * @param  mixed  $data
     * @param  callable  $callback
     * @return array
     */
    public function transformResource($data, callable $callback)
    {
        return $this->transformFields(
            RippleFlexiblePresenter::make($data), $callback
        );
    }

    /**
     * Transform the collection data with fields.
     *
     * @param  array|\Illuminate\Support\Collection  $data
     * @param  callable  $callback
     * @return array
     */
    public function transformCollection($data, callable $callback)
    {
        return $this->transformFields(
            RippleFlexiblePresenter::collection($data), $callback
        );
    }

    /**
     * Transform the fields instance to array.
     *
     * @param  \AdditionApps\FlexiblePresenter\FlexiblePresenter  $flexiblePresenter
     * @param  callable  $callback
     * @return array
     */
    public function transformFields(FlexiblePresenter $flexiblePresenter, callable $callback)
    {
        return $flexiblePresenter
            ->with(function (Model $model) use ($callback) {
                return collect($this->fields)
                    ->mapWithKeys(function (Field $field) use ($model, $callback) {
                        return $callback($model, $field);
                    })
                    ->all();
            })
            ->get();
    }
}
