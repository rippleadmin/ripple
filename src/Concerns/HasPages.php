<?php

namespace RippleAdmin\Concerns;

use RippleAdmin\Page;
use RippleAdmin\Droplet;

trait HasPages
{
    /**
     * The pages instance.
     *
     * @var array
     */
    protected $pages = [];

    /**
     * Get all pages instance.
     *
     * @return array
     */
    public function pages()
    {
        return $this->pages;
    }

    /**
     * Get the page instance.
     *
     * @param  string  $name
     * @return \RippleAdmin\Page
     */
    public function page(string $name)
    {
        return $this->pages[$name];
    }

    /**
     * Add a new page instance.
     *
     * @param  string  $name
     * @param  \RippleAdmin\Page  $page
     * @return $this
     */
    public function addPage(string $name, Page $page)
    {
        $this->pages[$name] = $page;

        return $this;
    }

    /**
     * Bootstrap all droplets instance.
     *
     * @return $this
     */
    public function bootPages()
    {
        foreach ($this->pages as $name => $page) {
            /** @var \RippleAdmin\Page $page */
            $page = app($page);

            $this->addPage($name, $page);

            if ($this instanceof Droplet) {
                $page->setDroplet($this);
            }

            $page->boot();
        }

        return $this;
    }
}
