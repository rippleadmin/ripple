<?php

namespace WaterAdmin;

use WaterAdmin\Concerns\HasPresenter;

class Table extends Component
{
    /**
     * The component name.
     *
     * @var string
     */
    protected $name = 'Table';

    /**
     * The table columns.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * The data in table.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Get the table columns.
     *
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Set the table columns.
     *
     * @param  array  $columns
     * @return $this
     */
    public function setColumns(array $columns)
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * Get the data in table.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the data in table.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the component props.
     *
     * @return array
     */
    public function props()
    {
        return [
            'columns' => $this->getColumns(),
            'data' => $this->getData(),
        ];
    }
}
