<?php

namespace Database\Seeders;

use App\Models\Floor;
use Illuminate\Database\Seeder;

class FloorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Floor::factory()->times(20)->create();
    }
}
