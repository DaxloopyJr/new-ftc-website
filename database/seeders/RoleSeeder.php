<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator',
            'description' => 'Full access to all features',
            'permissions' => ['*'],
        ]);

        Role::create([
            'name' => 'editor',
            'display_name' => 'Editor',
            'description' => 'Can manage content but not users',
            'permissions' => [
                'pages.manage',
                'news.manage',
                'publications.manage',
                'info_library.manage',
                'media.manage',
                'team_members.manage',
                'contacts.view',
                'hero_slides.manage',
                'advertisements.manage',
            ],
        ]);

        Role::create([
            'name' => 'viewer',
            'display_name' => 'Viewer',
            'description' => 'Read-only access to admin panel',
            'permissions' => [
                'pages.view',
                'news.view',
                'publications.view',
                'contacts.view',
            ],
        ]);
    }
}
