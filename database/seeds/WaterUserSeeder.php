<?php

use Illuminate\Database\Seeder;
use WaterAdmin\Models\User;

class WaterUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 3)->create();
    }
}
