<?php

namespace WaterAdmin\Pages;

use Illuminate\Database\Eloquent\Model;
use WaterAdmin\Contracts\Field\Displayable;
use WaterAdmin\Field;
use WaterAdmin\Page;

class TablePage extends Page
{
    /**
     * The component name.
     *
     * @var string
     */
    protected $name = 'Table';

    /**
     * Bootstrap the page instance.
     *
     * @return void
     */
    public function boot()
    {
        $this->title('Table page');
    }

    /**
     * Get the page props.
     *
     * @return array
     */
    public function props()
    {
        return [
            'title' => $this->title,
            'columns' => $this->columns(),
            'data' => $this->data(),
        ];
    }

    /**
     * Get the table columns.
     *
     * @return array
     */
    public function columns()
    {
        return $this->waterDrop->getFieldsLabel();
    }

    /**
     * Get the table data.
     *
     * @return array
     */
    public function data()
    {
        return $this->waterDrop->transformCollection(
            $this->waterDrop->getModels(),
            function (Model $model, Field $field) {
                if ($field instanceof Displayable) {
                    $key = $field->key();
                    $component = $field->renderDisplayable(
                        $this->waterDrop->getModelAttribute($model, $key), $model
                    );

                    return [$key => $component];
                }

                return [];
            }
        );
    }
}
