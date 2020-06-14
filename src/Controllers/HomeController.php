<?php

namespace WaterAdmin\Controllers;

use Inertia\Inertia;
use WaterAdmin\Components\Aaa;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'aaa' => Aaa::make(),
        ]);
    }
}
