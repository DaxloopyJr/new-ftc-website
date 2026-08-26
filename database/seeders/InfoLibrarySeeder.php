<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InfoLibrary;

class InfoLibrarySeeder extends Seeder
{
    public function run(): void
    {
        InfoLibrary::create([
            'title' => 'Case Digest: Merger Review Principles',
            'slug' => 'case-digest-merger-review-principles',
            'description' => 'Summary of key principles established in merger review decisions.',
            'file_path' => 'uploads/info-library/merger-digest.pdf',
            'file_size' => 1024000,
            'file_type' => 'application/pdf',
            'category' => 'case_digest',
            'case_number' => 'FCT/MER/2023/01',
            'parties' => 'Company A vs. Fair Competition Commission',
            'decision_date' => '2023-06-15',
            'is_published' => true,
        ]);

        InfoLibrary::create([
            'title' => 'FCT Appeal No. 12 of 2023',
            'slug' => 'fct-appeal-12-2023',
            'description' => 'Full judgment on restrictive trade practices appeal.',
            'file_path' => 'uploads/info-library/appeal-12-2023.pdf',
            'file_size' => 2048000,
            'file_type' => 'application/pdf',
            'category' => 'decided_cases',
            'case_number' => 'FCT/APP/2023/12',
            'parties' => 'XYZ Limited vs. Fair Competition Commission',
            'decision_date' => '2023-09-20',
            'is_published' => true,
        ]);

        InfoLibrary::create([
            'title' => 'Registered Case: FCT/APP/2024/05',
            'slug' => 'registered-case-2024-05',
            'description' => 'Appeal against Commission decision on abuse of dominant position.',
            'file_path' => 'uploads/info-library/case-2024-05.pdf',
            'file_size' => 512000,
            'file_type' => 'application/pdf',
            'category' => 'registered_cases',
            'case_number' => 'FCT/APP/2024/05',
            'parties' => 'ABC Corporation vs. Fair Competition Commission',
            'decision_date' => null,
            'is_published' => true,
        ]);

        InfoLibrary::create([
            'title' => 'Cause List - December 2024',
            'slug' => 'cause-list-december-2024',
            'description' => 'Hearing schedule for December 2024.',
            'file_path' => 'uploads/info-library/cause-list-dec-2024.pdf',
            'file_size' => 256000,
            'file_type' => 'application/pdf',
            'category' => 'cause_list',
            'case_number' => null,
            'parties' => null,
            'decision_date' => null,
            'is_published' => true,
        ]);

        InfoLibrary::create([
            'title' => 'FCT Information Brochure',
            'slug' => 'fct-information-brochure',
            'description' => 'General information about the Tribunal and its services.',
            'file_path' => 'uploads/info-library/fct-brochure.pdf',
            'file_size' => 1536000,
            'file_type' => 'application/pdf',
            'category' => 'brochure',
            'case_number' => null,
            'parties' => null,
            'decision_date' => null,
            'is_published' => true,
        ]);
    }
}
