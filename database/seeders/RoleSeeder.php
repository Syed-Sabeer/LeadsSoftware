<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

          $adminRole = Role::create(['name' => 'admin']);

            $adminUser = User::firstOrCreate([
                    'email' => 'admin@gmail.com',
                ], [
                    'name' => 'Admin User',
                    'email' => 'admin@gmail.com',
                    'username' => 'admin',
                    'password' => Hash::make ('admin@Leads2025'),
                    'email_verified_at' => now(),
                ]);

        $adminUser->assignRole($adminRole);

        $adminProfile = $adminUser->profile()->firstOrCreate([
            'user_id' => $adminUser->id,
        ], [
            'user_id' => $adminUser->id,
            'first_name' => $adminUser->name,
        ]);


    }
}
