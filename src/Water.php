<?php

namespace RippleAdmin;

use Illuminate\Routing\Router;
use Illuminate\Support\Traits\Macroable;
use ReflectionClass;
use ReflectionMethod;
use RippleAdmin\Concerns\HasActions;
use RippleAdmin\Concerns\HasPages;
use RippleAdmin\Droplets\CreateDroplet;
use RippleAdmin\Droplets\DestroyDroplet;
use RippleAdmin\Droplets\EditDroplet;
use RippleAdmin\Droplets\IndexDroplet;
use RippleAdmin\Droplets\ShowDroplet;

abstract class Water
{
    use Macroable,
        HasPages,
        HasActions;

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
     * @var string[]|\RippleAdmin\Droplet[]
     */
    protected $droplets = [
        'index' => IndexDroplet::class,
        'show' => ShowDroplet::class,
        // 'create' => CreateDroplet::class,
        // 'edit' => EditDroplet::class,
        // 'destroy' => DestroyDroplet::class,
    ];

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
    abstract public function fields(): array;

    /**
     * Bootstrap water model.
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
     * Bootstrap all droplets instance.
     *
     * @return void
     */
    public function bootDroplets()
    {
        foreach ($this->droplets as $name => $droplet) {
            /** @var \RippleAdmin\Droplet $droplet */
            $droplet = new $droplet($this);
            $droplet->fields($this->fields());

            $this->addDroplet($name, $droplet);

            static::mixinDroplet($droplet);
        }
    }

    /**
     * Get all droplets instance.
     *
     * @return \RippleAdmin\Droplet[]
     */
    public function droplets(): array
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
     * Add a new droplet instance.
     *
     * @param  string  $name
     * @param  \RippleAdmin\Droplet  $droplet
     * @return $this
     */
    public function addDroplet(string $name, Droplet $droplet)
    {
        $this->droplets[$name] = $droplet;

        return $this;
    }

    /**
     * Mix droplet instance into the water model.
     *
     * @param  \RippleAdmin\Droplet  $droplet
     * @param  bool  $replace
     * @return void
     */
    public static function mixinDroplet(Droplet $droplet, $replace = true)
    {
        $methods = array_filter((new ReflectionClass($droplet))->getMethods(
            ReflectionMethod::IS_PUBLIC
        ), function (ReflectionMethod $method) use ($droplet) {
            return in_array($method->name, $droplet->methods);
        });

        foreach ($methods as $method) {
            if ($replace || ! static::hasMacro($method->name)) {
                static::macro($method->name, fn (...$parameters) =>
                    $method->invoke($droplet, ...$parameters)
                );
            }
        }
    }

    /**
     * Register the water routes.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @param  string  $routePrefix
     * @return void
     */
    public function registerRoute(Router $router, string $routePrefix)
    {
        $router->prefix($routePrefix)->group(function (Router $router) {
            $this->registerDropletsRoute($router);
            $this->routes($router);
        });
    }

    /**
     * Register the droplets routes.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    protected function registerDropletsRoute(Router $router)
    {
        foreach ($this->droplets as $droplet) {
            $droplet->routes($router);
        }
    }

    /**
     * Get the route action.
     *
     * @param  string  $action
     * @return string[]
     */
    public function action(string $action): array
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
