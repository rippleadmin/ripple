<?php

namespace WaterAdmin\Concerns;

use WaterAdmin\Page;
use WaterAdmin\WaterDrop;

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
     * @return \WaterAdmin\Page
     */
    public function page(string $name)
    {
        return $this->pages[$name];
    }

    /**
     * Add a new page instance.
     *
     * @param  string  $name
     * @param  \WaterAdmin\Page  $page
     * @return $this
     */
    public function addPage(string $name, Page $page)
    {
        $this->pages[$name] = $page;

        return $this;
    }

    /**
     * Bootstrap all water drops instance.
     *
     * @return $this
     */
    public function bootPages()
    {
        foreach ($this->pages as $name => $page) {
            /** @var \WaterAdmin\Page $page */
            $page = app($page);

            $this->addPage($name, $page);

            if ($this instanceof WaterDrop) {
                $page->setWaterDrop($this);
            }

            $page->boot();
        }

        return $this;
    }
}
