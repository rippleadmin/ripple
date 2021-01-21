<?php

namespace RippleAdmin\Droplets;

use Illuminate\Routing\Router;
use RippleAdmin\Droplet;
use RippleAdmin\Pages\TablePage;

class EditDroplet extends Droplet
{
    public $methods = [
        'edit',
    ];

    public function edit()
    {
        // return $this->page(TablePage::class);
    }

    public function routes(Router $router)
    {
        // $router->get('/', $this->water->action('index'));
    }
}
