<?php

namespace RippleAdmin\Droplets;

use Illuminate\Routing\Router;
use RippleAdmin\Droplet;
use RippleAdmin\Pages\TablePage;

class DestroyDroplet extends Droplet
{
    public $methods = [
        'destroy',
    ];

    public function destroy()
    {
        // return $this->page(TablePage::class);
    }

    public function routes(Router $router)
    {
        // $router->get('/', $this->water->action('index'));
    }
}
