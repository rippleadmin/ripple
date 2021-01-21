<?php

namespace RippleAdmin\Components;

use RippleAdmin\Component;

class Detail extends Component
{
    protected $name = 'RDetail';

    protected $fields = [];
    protected $data = [];

    public function getFields()
    {
        return $this->fields;
    }

    public function setFields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    public function props()
    {
        return [
            'fields' => $this->fields,
            'data' => $this->data,
        ];
    }
}
