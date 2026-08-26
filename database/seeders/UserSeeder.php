<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $editorRole = Role::where('name', 'editor')->first();

        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@fct.go.tz',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Content Editor',
            'email' => 'editor@fct.go.tz',
            'password' => Hash::make('password'),
            'role_id' => $editorRole->id,
            'is_active' => true,
        ]);
    }
}
