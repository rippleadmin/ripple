<?php

namespace RippleAdmin;

use Illuminate\Http\Request;
use Illuminate\Support\Traits\Macroable;
use RippleAdmin\Concerns\HasDroplet;
use RippleAdmin\Concerns\HasWater;

abstract class Action
{
    use Macroable,
        HasWater,
        HasDroplet;

    /**
     * Handle the action.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void|\Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Support\Responsable
     */
    abstract public function handle(Request $request);
}
