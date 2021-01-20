<?php

use Illuminate\Database\Seeder;

class RippleAdminDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RippleUserSeeder::class);
    }
}
