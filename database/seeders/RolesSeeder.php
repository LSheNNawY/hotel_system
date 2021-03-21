<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $admin = User::where('email', 'admin@admin.com')->first();

        $adminRole          = Role::create(['name' => 'admin']);
        $managerRole        = Role::create(['name' => 'manager']);
        $receptionistRole   = Role::create(['name' => 'receptionist']);
        $userRole           = Role::create(['name' => 'user']);

        $admin->assignRole($adminRole);
    }
}
