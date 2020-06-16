<?php

namespace WaterAdmin;

use Illuminate\Http\Request;
use Illuminate\Support\Traits\Macroable;
use WaterAdmin\Concerns\HasWaterDrop;
use WaterAdmin\Concerns\HasWaterModel;

abstract class Operation
{
    use Macroable,
        HasWaterModel,
        HasWaterDrop;

    /**
     * Handle the operation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void|\Symfony\Component\HttpFoundation\Response|\Illuminate\Contracts\Support\Responsable
     */
    abstract public function handle(Request $request);
}
