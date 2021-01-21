<?php

namespace RippleAdmin\Pages;

use RippleAdmin\Components\Detail;
use RippleAdmin\Page;

class DetailPage extends Page
{
    protected $name = 'List/Detail';

    protected $title = 'Detail page';

    public function fields()
    {
        return $this->droplet->getFieldsLabel();
    }

    public function data()
    {
        return $this->droplet->buildModelData();
    }

    public function pageProps()
    {
        return [
            'detail' => Detail::make()
                ->setFields($this->fields())
                ->setData($this->data()),
        ];
    }
}
