<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publication;

class PublicationSeeder extends Seeder
{
    public function run(): void
    {
        Publication::create([
            'title' => 'Fair Competition Act No. 8 of 2003',
            'slug' => 'fair-competition-act-2003',
            'description' => 'The principal legislation establishing the Fair Competition Commission and the Fair Competition Tribunal.',
            'file_path' => 'uploads/publications/fair-competition-act.pdf',
            'file_size' => 2048000,
            'file_type' => 'application/pdf',
            'category' => 'acts_and_rules',
            'cover_image' => null,
            'year' => 2003,
            'is_published' => true,
        ]);

        Publication::create([
            'title' => 'Fair Competition Tribunal Rules of Procedure',
            'slug' => 'fct-rules-of-procedure',
            'description' => 'Rules governing the procedures of the Fair Competition Tribunal.',
            'file_path' => 'uploads/publications/fct-rules.pdf',
            'file_size' => 1536000,
            'file_type' => 'application/pdf',
            'category' => 'acts_and_rules',
            'cover_image' => null,
            'year' => 2005,
            'is_published' => true,
        ]);

        Publication::create([
            'title' => 'Strategic Plan 2020-2025',
            'slug' => 'strategic-plan-2020-2025',
            'description' => 'The Tribunal\'s five-year strategic plan outlining goals and strategies.',
            'file_path' => 'uploads/publications/strategic-plan-2020-2025.pdf',
            'file_size' => 5120000,
            'file_type' => 'application/pdf',
            'category' => 'strategic_plan',
            'cover_image' => null,
            'year' => 2020,
            'is_published' => true,
        ]);

        Publication::create([
            'title' => 'Annual Report 2023/2024',
            'slug' => 'annual-report-2023-2024',
            'description' => 'Comprehensive annual report covering Tribunal activities for FY 2023/2024.',
            'file_path' => 'uploads/publications/annual-report-2023-2024.pdf',
            'file_size' => 8192000,
            'file_type' => 'application/pdf',
            'category' => 'annual_report',
            'cover_image' => null,
            'year' => 2024,
            'is_published' => true,
        ]);

        Publication::create([
            'title' => 'Client Service Charter',
            'slug' => 'client-service-charter',
            'description' => 'The Tribunal\'s commitment to quality service delivery to its stakeholders.',
            'file_path' => 'uploads/publications/client-service-charter.pdf',
            'file_size' => 1024000,
            'file_type' => 'application/pdf',
            'category' => 'client_service_charter',
            'cover_image' => null,
            'year' => 2023,
            'is_published' => true,
        ]);
    }
}
