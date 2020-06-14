<?php

namespace WaterAdmin\Concerns;

use WaterAdmin\Page;
use WaterAdmin\PlainPage;
use WaterAdmin\WaterDrop;
use WaterAdmin\WaterModel;

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
     * @return \WaterAdmin\PlainPage
     */
    public function page(string $name)
    {
        return $this->pages[$name];
    }

    /**
     * Add a new page instance.
     *
     * @param  string  $name
     * @param  \WaterAdmin\PlainPage  $page
     * @return $this
     */
    public function addPage(string $name, PlainPage $page)
    {
        if ($page instanceof Page) {
            if ($this instanceof WaterModel) {
                $page->setWaterModel($this);
            } elseif ($this instanceof WaterDrop) {
                $page->setWaterDrop($this);
            }
        }

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
            $this->addPage($name, app($page));
        }

        return $this;
    }
}
