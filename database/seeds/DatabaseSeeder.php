<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(HouseSeeder::class);
        $this->call(LandSeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(UserSeeder::class);
    }
}
