<?php

namespace RippleAdmin\Pages;

use Illuminate\Database\Eloquent\Model;
use RippleAdmin\Components\Table;
use RippleAdmin\Contracts\Field\Displayable;
use RippleAdmin\Field;
use RippleAdmin\Page;

class TablePage extends Page
{
    /**
     * The component name.
     *
     * @var string
     */
    protected $name = 'List/Table';

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
    public function pageProps()
    {
        return [
            'table' => Table::make()
                ->setColumns($this->columns())
                ->setData($this->data()),
        ];
    }

    /**
     * Get the table columns.
     *
     * @return array
     */
    public function columns()
    {
        return $this->droplet->getFieldsLabel();
    }

    /**
     * Get the table data.
     *
     * @return array
     */
    public function data()
    {
        return $this->droplet->transformCollection(
            $this->droplet->getModels(),
            function (Model $model, Field $field) {
                if ($field instanceof Displayable) {
                    $key = $field->key();
                    $component = $field->renderDisplayable(
                        $this->droplet->getModelAttribute($model, $key), $model
                    );

                    return [$key => $component];
                }

                return [];
            }
        );
    }
}
