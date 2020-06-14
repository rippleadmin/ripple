<?php

namespace WaterAdmin;

use Illuminate\Contracts\Support\Responsable;
use Inertia\Inertia;
use WaterAdmin\Components\AbstractComponent;

abstract class PlainPage extends AbstractComponent implements Responsable
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return Inertia::render($this->name(), $this->props())
            ->toResponse($request);
    }
}
