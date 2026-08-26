<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSlide;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        HeroSlide::create([
            'title' => 'Welcome to the Fair Competition Tribunal',
            'subtitle' => 'Promoting Fair Competition and Consumer Welfare in Tanzania',
            'image_path' => 'assets/images/profile-side.png',
            'button_text' => 'Learn More',
            'button_link' => '/about-us',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        HeroSlide::create([
            'title' => 'Justice, Fairness, Transparency',
            'subtitle' => 'An Independent Quasi-Judicial Body Under the Fair Competition Act',
            'image_path' => 'assets/images/profile-side.png',
            'button_text' => 'Our Services',
            'button_link' => '/appeal-procedures',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        HeroSlide::create([
            'title' => 'File Your Appeal Online',
            'subtitle' => 'Access Our Digital Case Filing System for Convenient Submission',
            'image_path' => 'assets/images/profile-side.png',
            'button_text' => 'Digital Filing',
            'button_link' => '/digital-case-filing',
            'sort_order' => 3,
            'is_active' => true,
        ]);
    }
}
