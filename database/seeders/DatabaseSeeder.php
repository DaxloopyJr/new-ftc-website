<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            PageSeeder::class,
            TeamMemberSeeder::class,
            HeroSlideSeeder::class,
            NewsSeeder::class,
            PublicationSeeder::class,
            InfoLibrarySeeder::class,
            AdvertisementSeeder::class,
        ]);
    }
}
