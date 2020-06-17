<?php

use Illuminate\Database\Seeder;

class WaterAdminDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(WaterUserSeeder::class);
    }
}
