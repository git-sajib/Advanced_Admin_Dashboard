<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('users')->truncate(); //run specific seeder class Ex: "php artisan db:seed --class=UserSeeder"
        // Create Admin1
        $adminRoleId = Role::where('role_slug', 'admin')->first()->id;
        User::UpdateOrCreate([
            'role_id' => $adminRoleId,
            'name' => 'Admin1',
            'email' => 'admin1@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'), //1234
            'remember_token' => Str::random(10),
        ]);

        // Create Admin2
        User::UpdateOrCreate([
            'role_id' => $adminRoleId,
            'name' => 'Admin2',
            'email' => 'admin2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'), //1234
            'remember_token' => Str::random(10),
        ]);

        //Create User1
        $userRoleId = Role::where('role_slug', 'user')->first()->id;
        User::UpdateOrCreate([
            'role_id' => $userRoleId,
            'name' => 'User1',
            'email' => 'user1@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'), //1234
            'remember_token' => Str::random(10),
        ]);

        //Create User2
        User::UpdateOrCreate([
            'role_id' => $userRoleId,
            'name' => 'User2',
            'email' => 'user2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'), //1234
            'remember_token' => Str::random(10),
        ]);

        //Create Manager1
        $userRoleId = Role::where('role_slug', 'manager')->first()->id;
        User::UpdateOrCreate([
            'role_id' => $userRoleId,
            'name' => 'Manager1',
            'email' => 'manager1@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'), //1234
            'remember_token' => Str::random(10),
        ]);

        //Create Manager2
        User::UpdateOrCreate([
            'role_id' => $userRoleId,
            'name' => 'Manager2',
            'email' => 'manager2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('1234'), //1234
            'remember_token' => Str::random(10),
        ]);
    }
}
