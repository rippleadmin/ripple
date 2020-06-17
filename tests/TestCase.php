<?php

namespace WaterAdmin\Test;

use Mockery as m;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use WaterAdmin\Models\User;
use WaterAdmin\Water;
use WaterAdmin\WaterServiceProvider;

class TestCase extends OrchestraTestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->instance('path.public', __DIR__.'/Stubs/public');
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        Water::setRoutesPath(__DIR__.'/Stubs/routes/water.php');
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            WaterServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Water' => Water::class,
        ];
    }

    /**
     * Mock an instance of an object in the container.
     *
     * @param  string  $abstract
     * @param  \Closure|null  $mock
     * @return object
     */
    protected function mock($abstract, $mock = null)
    {
        return $this->app->instance($abstract, m::mock(...array_filter(func_get_args())));
    }

    /**
     * Call the given URI and return the Response.
     *
     * @param  string  $method
     * @param  string  $uri
     * @param  array  $parameters
     * @param  array  $cookies
     * @param  array  $files
     * @param  array  $server
     * @param  string|null  $content
     * @return \Illuminate\Testing\TestResponse
     */
    public function call($method, $uri, $parameters = [], $cookies = [], $files = [], $server = [], $content = null)
    {
        $uri = $this->app['config']->get('water.prefix').'/'.ltrim($uri, '/');

        return parent::call($method, $uri, $parameters, $cookies, $files, $server, $content);
    }

    /**
     * Create and authenticate user.
     *
     * @return void
     */
    protected function authenticate()
    {
        $user = User::create([
            'name' => 'Lucas Yang',
            'email' => 'yangchenshin77@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $this->actingAs($user);

        $this->app['request']->setUserResolver(function () use ($user) {
            return $user;
        });
    }
}
