<?php

use Illuminate\Database\Seeder;
use RippleAdmin\Models\User;

class RippleUserSeeder extends Seeder
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
