<?php

use Illuminate\Database\Seeder;
use App\Models\Land;

class LandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(Land::class, 5)->create();
    }
}
