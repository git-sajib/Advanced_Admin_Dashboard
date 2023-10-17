<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moduleArray = [
            'Admin Dashboard',
            'Role Management',
            'User Management',
            'Permission Management',
        ];

        foreach ($moduleArray as $module) {
            Module::updateOrCreate([
                'module_name' => $module,
                'module_slug' => Str::slug($module),
            ]);
        }
    }
}
