<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'Fair Competition Tribunal', 'group' => 'general', 'type' => 'text', 'label' => 'Site Name'],
            ['key' => 'site_description', 'value' => 'Independent quasi-judicial body established under the Fair Competition Act No. 8 of 2003', 'group' => 'general', 'type' => 'textarea', 'label' => 'Site Description'],
            ['key' => 'contact_address', 'value' => '10th Floor, IPS Building, Samora Avenue/Azikiwe Street, P.O. Box 4567, Dar es Salaam, Tanzania', 'group' => 'contact', 'type' => 'textarea', 'label' => 'Contact Address'],
            ['key' => 'contact_phone', 'value' => '+255 22 2123456', 'group' => 'contact', 'type' => 'text', 'label' => 'Contact Phone'],
            ['key' => 'contact_email', 'value' => 'info@fct.go.tz', 'group' => 'contact', 'type' => 'text', 'label' => 'Contact Email'],
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/fcttanzania', 'group' => 'social', 'type' => 'text', 'label' => 'Facebook URL'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/fcttanzania', 'group' => 'social', 'type' => 'text', 'label' => 'Twitter URL'],
            ['key' => 'social_youtube', 'value' => 'https://youtube.com/fcttanzania', 'group' => 'social', 'type' => 'text', 'label' => 'YouTube URL'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/fcttanzania', 'group' => 'social', 'type' => 'text', 'label' => 'Instagram URL'],
            ['key' => 'office_hours', 'value' => 'Monday - Friday: 08:00 AM - 04:30 PM', 'group' => 'general', 'type' => 'text', 'label' => 'Office Hours'],
            ['key' => 'footer_copyright', 'value' => 'Fair Competition Tribunal. All Rights Reserved.', 'group' => 'general', 'type' => 'text', 'label' => 'Footer Copyright'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
