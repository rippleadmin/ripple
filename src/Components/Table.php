<?php

namespace RippleAdmin\Components;

use RippleAdmin\Component;

class Table extends Component
{
    protected $name = 'RTable';

    protected $columns = [];
    protected $data = [];
    protected $links = [];
    protected $showPaginator = false;

    public function getColumns()
    {
        return $this->columns;
    }

    public function setColumns(array $columns)
    {
        $this->columns = $columns;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData(array $data)
    {
        if (isset($data['data']) && isset($data['links'])) {
            $this->links = $data['links'];
            $this->showPaginator = $data['showPaginator'] ?? false;
            $data = $data['data'];
        }

        $this->data = $data;

        return $this;
    }

    public function getPaginationLinks()
    {
        return $this->links;
    }

    public function setPaginationLinks(array $links)
    {
        $this->links = $links;

        return $this;
    }

    public function props()
    {
        return [
            'columns' => $this->columns,
            'data' => $this->data,
            'links' => $this->links,
            'showPaginator' => $this->showPaginator,
        ];
    }
}
