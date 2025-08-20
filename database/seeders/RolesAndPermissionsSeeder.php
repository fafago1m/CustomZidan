<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat roles
        $roleAdmin = Role::firstOrCreate(['name' => 'admin']);
        $roleReseller = Role::firstOrCreate(['name' => 'reseller']);

        // Buat user admin demo
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('123'), // default password
            ]
        );
        $admin->assignRole($roleAdmin);

        // Buat user reseller demo
        $reseller = User::firstOrCreate(
            ['email' => 'reseller@gmail.com'],
            [
                'name' => 'Reseller User',
                'password' => Hash::make('123'),
            ]
        );
        $reseller->assignRole($roleReseller);
    }
}
