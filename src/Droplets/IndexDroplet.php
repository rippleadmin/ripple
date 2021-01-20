<?php

namespace RippleAdmin\Droplets;

use Illuminate\Routing\Router;
use RippleAdmin\Droplet;
use RippleAdmin\Pages\TablePage;

class IndexDroplet extends Droplet
{
    protected $pages = [
        'index' => TablePage::class,
    ];

    public function index()
    {
        return $this->page('index');
    }

    public function routes(Router $router)
    {
        $router->get('/', $this->water->action('index'));
    }
}
