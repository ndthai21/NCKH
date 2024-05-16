<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role; // Import the Role model

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'super-admin', 'display_name' => 'Super Admin', 'group' => 'system'],
            ['name' => 'khoa', 'display_name' => 'Khoa', 'group' => 'system'],
            ['name' => 'lien-chi', 'display_name' => 'Lien chi', 'group' => 'system'],
            ['name' => 'hoi_dong', 'display_name' => 'Hoi dong', 'group' => 'system'],
            ['name' => 'user', 'display_name' => 'User', 'group' => 'system'],
        ];

        foreach($roles as $role){
            Role::updateOrCreate($role);
        }

        $permission = [
            ['name' => 'create-user', 'display_name' => 'Create User', 'group' => 'User'],
            ['name' => 'update-user', 'display_name' => 'Update User', 'group' => 'User'],
            ['name' => 'show-user', 'display_name' => 'Show User', 'group' => 'User'],
            ['name' => 'delete-user', 'display_name' => 'Delete User', 'group' => 'User'],

            ['name' => 'create-role', 'display_name' => 'Create Role', 'group' => 'Role'],
            ['name' => 'update-role', 'display_name' => 'Update Role', 'group' => 'Role'],
            ['name' => 'show-role', 'display_name' => 'Show Role', 'group' => 'Role'],
            ['name' => 'delete-role', 'display_name' => 'Delete Role', 'group' => 'Role'],

        ];

        foreach($permission as $items){
            Permission::updateOrCreate($items);
        }
    }
}
