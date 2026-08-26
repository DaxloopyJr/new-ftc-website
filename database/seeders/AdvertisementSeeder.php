<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Advertisement;

class AdvertisementSeeder extends Seeder
{
    public function run(): void
    {
        Advertisement::create([
            'title' => 'Digital Case Filing Now Available',
            'image_path' => 'assets/images/profile-side.png',
            'link_url' => '/digital-case-filing',
            'position' => 'home_middle',
            'start_date' => now()->subDays(30),
            'end_date' => now()->addDays(365),
            'is_active' => true,
        ]);

        Advertisement::create([
            'title' => 'Join Our Team - Career Opportunities',
            'image_path' => 'assets/images/profile-side.png',
            'link_url' => '/careers',
            'position' => 'home_bottom',
            'start_date' => now()->subDays(10),
            'end_date' => now()->addDays(90),
            'is_active' => true,
        ]);
    }
}
