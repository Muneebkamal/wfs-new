<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Create Super Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@wfs.com'],
            [
                'name' => 'Admin',
                'full_name' => 'Super Admin',
                'password' => Hash::make('password'), // change this
                'email_verified_at' => now(),
                'status' => 1,
                'role_id' => 1, // optional: if you use this column
            ]
        );
        // Assign SuperAdmin role
        $admin->assignRole('SuperAdmin');

        // Assign all permissions (optional but redundant if role has all perms)
        $admin->syncPermissions(Permission::all());
    }
}
