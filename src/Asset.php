<?php

namespace WaterAdmin\WaterAdmin;

class Asset
{
    /**
     * The asset path.
     *
     * @var string
     */
    protected $path;

    /**
     * The asset manifest directory.
     *
     * @var string
     */
    protected $manifestDirectory;

    /**
     * Create a new asset instance.
     *
     * @param  string  $name
     * @param  string  $path
     * @param  string  $manifestDirectory
     * @return void
     */
    public function __construct(string $path, string $manifestDirectory = '')
    {
        $this->path = $path;
        $this->manifestDirectory = $manifestDirectory;
    }

    /**
     * Get the asset path.
     *
     * @return string
     */
    public function path()
    {
        return $this->path;
    }

    /**
     * Get the asset manifest directory.
     *
     * @return string
     */
    public function manifestDirectory()
    {
        return $this->manifestDirectory;
    }
}
