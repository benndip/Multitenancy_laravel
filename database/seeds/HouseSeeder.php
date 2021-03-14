<?php

use Illuminate\Database\Seeder;
use \App\Models\House;

class HouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(House::class, 5)->create();
    }
}
