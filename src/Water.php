<?php

namespace RippleAdmin;

use Illuminate\Routing\Router;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Macroable;
use ReflectionClass;
use ReflectionMethod;
use RippleAdmin\Concerns\HasOperations;
use RippleAdmin\Concerns\HasPages;
use RippleAdmin\Droplets\IndexDroplet;
use RuntimeException;

abstract class Water
{
    use Macroable,
        HasPages,
        HasOperations;

    /**
     * The original model class.
     *
     * @var string
     */
    protected $model;

    /**
     * The original model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $modelInstance;

    /**
     * The droplets instance.
     *
     * @var array
     */
    protected $droplets = [
        'index' => IndexDroplet::class,
        // 'show' => ShowDroplet::class,
        // 'create' => CreateDroplet::class,
        // 'edit' => EditDroplet::class,
        // 'destroy' => DestroyDroplet::class,
    ];

    /**
     * Create a new water model instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->bootDroplets();
        $this->boot();
    }

    /**
     * Define the water model fields.
     *
     * @return \RippleAdmin\Field[]
     */
    abstract public function fields();

    /**
     * Bootstrap model.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Get the base eloquent model instance.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function eloquent()
    {
        if (! $this->modelInstance) {
            $this->modelInstance = app($this->model);
        }

        return $this->modelInstance;
    }

    /**
     * Get all droplets instance.
     *
     * @return array
     */
    public function droplets()
    {
        return $this->droplets;
    }

    /**
     * Get the droplet instance.
     *
     * @param  string  $name
     * @return \RippleAdmin\Droplet
     */
    public function droplet(string $name)
    {
        return $this->droplets[$name];
    }

    /**
     * Bootstrap all droplets instance.
     *
     * @return void
     */
    public function bootDroplets()
    {
        foreach ($this->droplets as $name => $droplet) {
            if (method_exists(static::class, Str::camel($name))) {
                throw new RuntimeException(
                    sprintf('Droplet name "%s" is exists in %s::class.', $name, static::class)
                );
            }

            /** @var \RippleAdmin\Droplet $droplet */
            $droplet = app($droplet);
            $droplet->fields($this->fields());

            $this->addDroplet($name, $droplet);
            // $this->addDroplet(
            //     $name, $this->{Str::camel($name)}($droplet)
            // );

            static::mixinDroplet($droplet, ['routes']);
        }
    }

    /**
     * Add a new droplet instance.
     *
     * @param  string  $name
     * @param  string|\RippleAdmin\Droplet  $droplet
     * @return $this
     */
    public function addDroplet(string $name, Droplet $droplet)
    {
        $this->droplets[$name] = $droplet;
        $droplet->setWater($this);

        // Set pages from droplets
        foreach ($droplet->pages() as $name => $page) {
            $this->addPage($name, $page);
            $page->setWater($this);
        }

        // Set operations from droplets
        foreach ($droplet->operations() as $name => $operation) {
            $this->addOperation($name, $operation);
            $operation->setWater($this);
        }

        return $this;
    }

    public static function mixinDroplet(Droplet $droplet, array $except = [], $replace = true)
    {
        $methods = Arr::except((new ReflectionClass($droplet))->getMethods(
            ReflectionMethod::IS_PUBLIC
        ), $except);

        foreach ($methods as $method) {
            if ($replace || ! static::hasMacro($method->name)) {
                static::macro($method->name, fn () => $method->invoke($droplet));
            }
        }
    }

    public function registerRoute(Router $router, string $routePrefix)
    {
        $router->prefix($routePrefix)->group(function (Router $router) {
            $this->registerDropletsRoute($router);
            $this->routes($router);
        });
    }

    protected function registerDropletsRoute(Router $router)
    {
        foreach ($this->droplets as $droplet) {
            $router->droplet($droplet);
        }
    }

    public function action(string $action)
    {
        return [static::class, $action];
    }

    /**
     * Define the routes of the water model.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    protected function routes(Router $router)
    {
        //
    }
}
