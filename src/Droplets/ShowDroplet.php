<?php

namespace RippleAdmin\Droplets;

use Illuminate\Routing\Router;
use RippleAdmin\Droplet;
use RippleAdmin\Pages\DetailPage;

class ShowDroplet extends Droplet
{
    public $methods = [
        'show',
    ];

    public function show($id)
    {
        $this->model($id);

        return $this->page(DetailPage::class);
    }

    public function routes(Router $router)
    {
        $router->get('/{id}', $this->water->action('show'));
    }
}
