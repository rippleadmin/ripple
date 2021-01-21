<?php

namespace RippleAdmin\Droplets;

use Illuminate\Routing\Router;
use RippleAdmin\Droplet;
use RippleAdmin\Pages\TablePage;

class CreateDroplet extends Droplet
{
    public $methods = [
        'create',
    ];

    public function create()
    {
        // return $this->page(TablePage::class);
    }

    public function routes(Router $router)
    {
        // $router->get('/', $this->water->action('index'));
    }
}
