<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsEvent;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        NewsEvent::create([
            'title' => 'FCT Hosts Regional Competition Workshop',
            'slug' => 'fct-hosts-regional-competition-workshop',
            'excerpt' => 'The Fair Competition Tribunal hosted a regional workshop on competition law enforcement for East African member states.',
            'content' => '<p>The Fair Competition Tribunal successfully hosted a three-day regional workshop on competition law enforcement, bringing together representatives from competition authorities across East Africa. The workshop focused on harmonizing competition policies and sharing best practices in adjudication.</p><p>Participants included delegates from Kenya, Uganda, Rwanda, Burundi, and Tanzania. The event was officially opened by the Chairperson, Hon. Dr. John Mwakyusa, who emphasized the importance of regional cooperation in competition law enforcement.</p>',
            'featured_image' => null,
            'event_date' => '2024-11-15',
            'location' => 'Dar es Salaam',
            'is_published' => true,
            'published_at' => now()->subDays(10),
        ]);

        NewsEvent::create([
            'title' => 'New Tribunal Members Sworn In',
            'slug' => 'new-tribunal-members-sworn-in',
            'excerpt' => 'Two new members were sworn in to serve on the Fair Competition Tribunal following their appointment by the President.',
            'content' => '<p>His Excellency the President of the United Republic of Tanzania has appointed two new members to the Fair Competition Tribunal. The swearing-in ceremony took place at the Tribunal offices in Dar es Salaam.</p><p>The new members bring extensive expertise in competition law and economics, strengthening the Tribunal\'s capacity to handle the growing number of competition matters.</p>',
            'featured_image' => null,
            'event_date' => '2024-10-20',
            'location' => 'Dar es Salaam',
            'is_published' => true,
            'published_at' => now()->subDays(25),
        ]);

        NewsEvent::create([
            'title' => 'Annual Report 2023/2024 Released',
            'slug' => 'annual-report-2023-2024-released',
            'excerpt' => 'The Fair Competition Tribunal has released its Annual Report for the financial year 2023/2024.',
            'content' => '<p>The Fair Competition Tribunal is pleased to announce the release of its Annual Report for the financial year 2023/2024. The report highlights the Tribunal\'s achievements over the past year, including the disposal of 45 cases and the introduction of digital case filing services.</p><p>Key highlights include a 30% reduction in case backlog and improved turnaround times for case resolution. The report is available for download on the Publications page.</p>',
            'featured_image' => null,
            'event_date' => '2024-09-30',
            'location' => 'Dar es Salaam',
            'is_published' => true,
            'published_at' => now()->subDays(40),
        ]);

        NewsEvent::create([
            'title' => 'Digital Case Filing System Launch',
            'slug' => 'digital-case-filing-system-launch',
            'excerpt' => 'The Tribunal has launched a new digital case filing system to streamline the appeal process.',
            'content' => '<p>The Fair Competition Tribunal has officially launched its Digital Case Filing System, marking a significant milestone in the Tribunal\'s modernization efforts. The system allows parties to file cases, submit documents, and track case progress online.</p><p>The launch event was attended by stakeholders from the legal community, government agencies, and development partners. The system is expected to reduce filing times and improve access to justice.</p>',
            'featured_image' => null,
            'event_date' => '2024-08-15',
            'location' => 'Dar es Salaam',
            'is_published' => true,
            'published_at' => now()->subDays(60),
        ]);

        NewsEvent::create([
            'title' => 'Training on Competition Law for Judicial Officers',
            'slug' => 'training-competition-law-judicial-officers',
            'excerpt' => 'The Tribunal conducted a specialized training program on competition law for judicial officers from across Tanzania.',
            'content' => '<p>The Fair Competition Tribunal, in collaboration with the Tanzania Judiciary, conducted a comprehensive training program on competition law for judicial officers. The training aimed to build capacity among judicial officers in handling competition-related matters.</p><p>Over 50 judicial officers from various courts across Tanzania participated in the week-long training program.</p>',
            'featured_image' => null,
            'event_date' => '2024-07-10',
            'location' => 'Arusha',
            'is_published' => true,
            'published_at' => now()->subDays(90),
        ]);
    }
}
