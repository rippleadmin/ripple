<?php

namespace WaterAdmin;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Traits\Macroable;
use Inertia\Inertia;
use WaterAdmin\Components\AbstractComponent;

class PlainPage extends AbstractComponent implements Responsable
{
    use Macroable;

    /**
     * The page title.
     *
     * @var string
     */
    protected $title;

    /**
     * Bootstrap the page instance.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Define the page title.
     *
     * @param  string  $title
     * @return $this
     */
    public function title(string $title)
    {
        $this->title = $title;

        return $this;
    }

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

    /**
     * Get the page props.
     *
     * @return array
     */
    public function props()
    {
        return [
            'title' => $this->title,
        ];
    }
}
