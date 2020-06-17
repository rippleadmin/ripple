<?php

namespace WaterAdmin\Test\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use WaterAdmin\Test\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function testExample()
    {
        $this->get('/login')->assertOk();
    }
}
