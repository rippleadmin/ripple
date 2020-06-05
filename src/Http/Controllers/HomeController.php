<?php

namespace WaterAdmin\WaterAdmin\Http\Controllers;

use Inertia\Inertia;
use WaterAdmin\WaterAdmin\Components\Aaa;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'aaa' => Aaa::make(),
        ]);
    }
}
