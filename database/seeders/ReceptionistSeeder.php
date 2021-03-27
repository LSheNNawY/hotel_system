<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;

class ReceptionistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users =User::factory(User::class, 50)->create();
         foreach($users as $user){
             $user->assignRole('receptionist');
         }
        // User::factory()->times(20)->create();
    }
}
