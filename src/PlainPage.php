<?php

namespace WaterAdmin;

use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Traits\Macroable;
use Inertia\Inertia;
use InvalidArgumentException;
use WaterAdmin\Component;
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
     * Add the page row content.
     *
     * @param  array|\WaterAdmin\Component  $content
     * @return void
     */
    public function row($content)
    {
        if (is_array($content)) {
            //
        } elseif ($content instanceof Component) {
            //
        } else {
            throw new InvalidArgumentException(
                sprintf('The argument $content must be an instance of %s or array.', Component::class)
            );
        }

        return $this;
    }

    /**
     * Add the page content.
     *
     * @param  \WaterAdmin\Component  $content
     * @return void
     */
    public function content(Component $content)
    {
        //

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
