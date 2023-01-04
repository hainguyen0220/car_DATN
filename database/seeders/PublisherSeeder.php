<?php

namespace Database\Seeders;

use App\Models\Gara;
use Illuminate\Database\Seeder;

class GaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gara::factory(30)->create();
    }
}
