<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin role and assign all permisiion on it

        $adminPermissions = Permission::select('id')->get();

        Role::updateOrCreate([
            'role_name' => 'Admin',
            'role_slug' => 'admin',
            'role_note' => 'admin has all permission',
            'is_deletable' => false,
        ])->permissions()->sync($adminPermissions->pluck('id'));

        // Creat an user role

        Role::updateOrCreate([
            'role_name' => 'User',
            'role_slug' => 'user',
            'role_note' => 'user has limited permission',
            'is_deletable' => true,
        ]);
    }
}
