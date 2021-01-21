<?php

namespace RippleAdmin\Concerns;

use RippleAdmin\Droplet;

trait HasPages
{
    /**
     * Make a new page instance.
     *
     * @param  string  $page
     * @param  array  $parameters
     * @return \RippleAdmin\Page
     */
    public function page(string $page, array $parameters = [])
    {
        /** @var \RippleAdmin\Page $page */
        $page = app($page, $parameters);

        if ($this instanceof Droplet) {
            $page->setDroplet($this);
        }

        $page->boot();

        return $page;
    }
}
