<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteUpdateSeeder extends Seeder
{
    /**
     * Applies the Swahili menu titles and appearance settings.
     * Safe to run at any time (idempotent) — e.g. after the main
     * migration was already executed before the back-fill existed:
     *   php artisan db:seed --class=SiteUpdateSeeder
     */
    public function run(): void
    {
        // 1) Swahili page/menu titles
        $swTitles = [
            'about-us' => 'Kuhusu Sisi', 'history' => 'Historia', 'vision-mission' => 'Dira na Dhamira',
            'core-values-functions' => 'Maadili Makuu na Majukumu', 'administration' => 'Utawala',
            'organisation-structure' => 'Muundo wa Shirika', 'tribunal-members' => 'Wajumbe wa Mahakama',
            'management' => 'Usimamizi', 'appeal-procedures' => 'Taritibu za Rufaa',
            'how-to-appeal' => 'Jinsi ya Kufungua Rufaa', 'fee-structure' => 'Muonekano wa Ada',
            'forms' => 'Fomu', 'info-library' => 'Maktaba ya Taarifa', 'case-digest' => 'Muhtasari wa Kesi',
            'decided-cases' => 'Kesi Zilizoamuliwa', 'registered-cases' => 'Kesi Zilizosajiliwa',
            'cause-list' => 'Orodha ya Kesi', 'brochures' => 'Vipeperushi',
            'publications' => 'Machapisho', 'acts-and-rules' => 'Sheria na Kanuni',
            'strategic-plan' => 'Mpango Mkakati', 'client-service-charter' => 'Hati ya Huduma kwa Mteja',
            'annual-reports' => 'Ripoti za Mwaka', 'media-center' => 'Kituo cha Habari',
            'news' => 'Habari', 'photo-gallery' => 'Matunzio ya Picha',
            'video-gallery' => 'Matunzio ya Video', 'digital-case-filing' => 'Kufungua Kesi Mtandaoni',
            'contact-us' => 'Wasiliana Nasi',
        ];
        foreach ($swTitles as $slug => $swTitle) {
            Page::where('slug', $slug)->update(['title_sw' => $swTitle]);
        }

        // 2) Appearance settings (colors + skin)
        $appearance = [
            ['key' => 'appearance_primary_color', 'value' => '#1B5E20', 'group' => 'appearance', 'type' => 'color', 'label' => 'Primary Color'],
            ['key' => 'appearance_accent_color', 'value' => '#f5b301', 'group' => 'appearance', 'type' => 'color', 'label' => 'Accent Color'],
            ['key' => 'appearance_skin', 'value' => 'light', 'group' => 'appearance', 'type' => 'select', 'label' => 'Website Skin'],
        ];
        foreach ($appearance as $row) {
            DB::table('settings')->updateOrInsert(['key' => $row['key']], $row);
        }

        if ($this->command) {
            $this->command->info('Swahili menu titles and appearance settings applied.');
        }
    }
}
