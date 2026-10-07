<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        // About FCT Section
        $about = Page::create([
            'title' => 'About Us',
            'slug' => 'about-us',
            'content' => '<p>The Fair Competition Tribunal (FCT) is an independent quasi-judicial body established under Section 89 of the Fair Competition Act No. 8 of 2003. The Tribunal plays a crucial role in ensuring fair competition in the Tanzanian market by adjudicating appeals from the Fair Competition Commission.</p><p>Our mandate includes handling matters related to restrictive trade practices, abuse of dominant market position, mergers and acquisitions, and consumer welfare protection. The Tribunal operates independently to ensure that all market players compete on a level playing field.</p>',
            'meta_description' => 'Learn about the Fair Competition Tribunal, its mandate, and role in ensuring fair competition in Tanzania.',
            'sort_order' => 1,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'History',
            'slug' => 'history',
            'parent_id' => $about->id,
            'content' => '<p>The Fair Competition Tribunal was established under Section 89 of the Fair Competition Act No. 8 of 2003. The Tribunal was officially inaugurated on 15th March 2005, marking a significant milestone in Tanzania\'s competition law framework.</p><p>Since its inception, the Tribunal has handled numerous appeals and applications, contributing significantly to the development of competition jurisprudence in Tanzania. The establishment of the FCT was a response to the need for an independent body to review decisions made by the Fair Competition Commission.</p>',
            'meta_description' => 'The history and establishment of the Fair Competition Tribunal in Tanzania.',
            'sort_order' => 1,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'Vision & Mission',
            'slug' => 'vision-mission',
            'parent_id' => $about->id,
            'content' => '<h3>Vision</h3><p>To be a leading competition tribunal promoting fair competition and consumer welfare in Tanzania and the East African region.</p><h3>Mission</h3><p>To impartially and expeditiously adjudicate competition matters in accordance with the law, thereby fostering a competitive business environment that benefits consumers and promotes economic efficiency.</p>',
            'meta_description' => 'The vision and mission of the Fair Competition Tribunal.',
            'sort_order' => 2,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'Core Values and Functions',
            'slug' => 'core-values-functions',
            'parent_id' => $about->id,
            'content' => '<h3>Core Values</h3><ul><li><strong>Independence:</strong> Operating free from external influence in our decision-making.</li><li><strong>Integrity:</strong> Upholding the highest ethical standards in all our operations.</li><li><strong>Impartiality:</strong> Ensuring fair and unbiased adjudication of all matters.</li><li><strong>Transparency:</strong> Conducting proceedings openly and accessibly.</li><li><strong>Efficiency:</strong> Delivering timely resolutions to all cases.</li><li><strong>Excellence:</strong> Striving for the highest quality in our judicial services.</li></ul><h3>Functions</h3><ul><li>Hear and determine appeals from decisions of the Fair Competition Commission</li><li>Review merger decisions and restrictive trade practice matters</li><li>Issue orders and directions as may be necessary</li><li>Promote public awareness of competition law and policy</li></ul>',
            'meta_description' => 'Core values and functions of the Fair Competition Tribunal.',
            'sort_order' => 3,
            'is_published' => true,
        ]);

        // Administration Section
        $admin = Page::create([
            'title' => 'Administration',
            'slug' => 'administration',
            'content' => '<p>The administration of the Fair Competition Tribunal is structured to ensure efficient delivery of judicial services. The Tribunal is headed by the Chairperson, supported by the Registrar and other management staff.</p>',
            'sort_order' => 2,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'Organisation Structure',
            'slug' => 'organisation-structure',
            'parent_id' => $admin->id,
            'content' => '<p>The Fair Competition Tribunal operates under a structured organizational framework:</p><ul><li><strong>The Chairperson:</strong> Head of the Tribunal, presiding over proceedings</li><li><strong>Tribunal Members:</strong> Appointed members who hear and determine cases</li><li><strong>The Registrar:</strong> Chief administrator responsible for day-to-day operations</li><li><strong>Secretariat:</strong> Support staff handling registry, research, and administrative functions</li></ul>',
            'sort_order' => 1,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'Tribunal Members',
            'slug' => 'tribunal-members',
            'parent_id' => $admin->id,
            'content' => '<p>The Tribunal is composed of the Chairperson and not less than two but not more than four other members appointed by the President of the United Republic of Tanzania. Members are appointed based on their qualifications and experience in law, economics, commerce, or public administration.</p>',
            'sort_order' => 2,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'Management',
            'slug' => 'management',
            'parent_id' => $admin->id,
            'content' => '<p>The management of the Tribunal comprises the Registrar and department heads who oversee various administrative functions including case management, registry services, finance, human resources, and information technology.</p>',
            'sort_order' => 3,
            'is_published' => true,
        ]);

        // Appeal Procedures Section
        $appeal = Page::create([
            'title' => 'Appeal Procedures',
            'slug' => 'appeal-procedures',
            'content' => '<p>The Fair Competition Tribunal handles appeals from decisions of the Fair Competition Commission. Understanding the appeal process is essential for parties seeking to challenge Commission decisions.</p>',
            'sort_order' => 3,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'How to Appeal',
            'slug' => 'how-to-appeal',
            'parent_id' => $appeal->id,
            'content' => '<h3>Steps to File an Appeal</h3><ol><li>Obtain and complete the Appeal Form (Form FCT-001)</li><li>Attach a copy of the decision being appealed against</li><li>Attach the notice of appeal to the Commission</li><li>Pay the prescribed appeal fee</li><li>Submit six copies of the appeal documents to the Tribunal Registry</li><li>File the appeal within 30 days of the Commission decision</li></ol><p>The Registrar shall, upon receiving the appeal, register it and issue a Notice of Hearing to all parties.</p>',
            'sort_order' => 1,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'Fee Structure',
            'slug' => 'fee-structure',
            'parent_id' => $appeal->id,
            'content' => '<h3>Schedule of Fees</h3><table class="table table-bordered"><thead><tr><th>Type of Fee</th><th>Amount (TZS)</th></tr></thead><tbody><tr><td>Filing an Appeal</td><td>500,000</td></tr><tr><td>Application for Leave to Appeal</td><td>300,000</td></tr><tr><td>Application for Extension of Time</td><td>200,000</td></tr><tr><td>Application for Stay of Execution</td><td>200,000</td></tr><tr><td>Certified Copy of Judgment</td><td>50,000</td></tr><tr><td>Certified Copy of Proceedings</td><td>100,000</td></tr></tbody></table><p><em>Note: Fees are subject to review. Please confirm current fees with the Registry.</em></p>',
            'sort_order' => 2,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'Forms',
            'slug' => 'forms',
            'parent_id' => $appeal->id,
            'content' => '<p>All forms required for proceedings before the Tribunal can be downloaded from our website or obtained from the Tribunal Registry. Below is a list of available forms:</p><ul><li>Form FCT-001: Notice of Appeal</li><li>Form FCT-002: Application for Leave to Appeal</li><li>Form FCT-003: Application for Extension of Time</li><li>Form FCT-004: Application for Stay of Execution</li><li>Form FCT-005: Request for Certified Copies</li><li>Form FCT-006: Change of Address for Service</li></ul>',
            'sort_order' => 3,
            'is_published' => true,
        ]);

        // Info Library Section
        $infoLib = Page::create([
            'title' => 'Info Library',
            'slug' => 'info-library',
            'content' => '<p>The Information Library provides access to a comprehensive collection of legal resources including case digests, decided cases, registered cases, cause lists, and informational brochures.</p>',
            'sort_order' => 4,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'Case Digest',
            'slug' => 'case-digest',
            'parent_id' => $infoLib->id,
            'content' => '<p>Case digests provide summarized versions of Tribunal decisions, highlighting key legal principles and findings. These digests serve as valuable resources for legal practitioners, researchers, and the public.</p>',
            'sort_order' => 1,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'Decided Cases',
            'slug' => 'decided-cases',
            'parent_id' => $infoLib->id,
            'content' => '<p>Access the full text of all decided cases from the Fair Competition Tribunal. These decisions contribute to the development of competition law jurisprudence in Tanzania.</p>',
            'sort_order' => 2,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'Registered Cases',
            'slug' => 'registered-cases',
            'parent_id' => $infoLib->id,
            'content' => '<p>View the list of all cases currently registered with the Tribunal, including their status and next hearing dates.</p>',
            'sort_order' => 3,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'Cause List',
            'slug' => 'cause-list',
            'parent_id' => $infoLib->id,
            'content' => '<p>The Cause List shows all cases scheduled for hearing on specific dates. Parties and the public can check hearing dates and venues through this page.</p>',
            'sort_order' => 4,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'Brochures',
            'slug' => 'brochures',
            'parent_id' => $infoLib->id,
            'content' => '<p>Download informational brochures about the Tribunal, its services, and procedures. These materials are designed to help the public understand the Tribunal\'s functions and processes.</p>',
            'sort_order' => 5,
            'is_published' => true,
        ]);

        // Publications Section
        $pubs = Page::create([
            'title' => 'Publications',
            'slug' => 'publications',
            'content' => '<p>The Tribunal publishes various documents including Acts and Rules, Strategic Plans, Client Service Charter, and Annual Reports. These publications are available for download.</p>',
            'sort_order' => 5,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'Acts and Rules',
            'slug' => 'acts-and-rules',
            'parent_id' => $pubs->id,
            'content' => '<p>Access the Fair Competition Act No. 8 of 2003 and the Fair Competition Tribunal Rules of Procedure. These are the primary legal instruments governing the Tribunal\'s operations.</p>',
            'sort_order' => 1,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'Strategic Plan',
            'slug' => 'strategic-plan',
            'parent_id' => $pubs->id,
            'content' => '<p>The Strategic Plan outlines the Tribunal\'s goals, objectives, and strategies for achieving its mandate. The current strategic plan covers the period 2020-2025.</p>',
            'sort_order' => 2,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'Client Service Charter',
            'slug' => 'client-service-charter',
            'parent_id' => $pubs->id,
            'content' => '<p>The Client Service Charter outlines the Tribunal\'s commitment to providing quality services to its stakeholders. It details the standards of service that clients can expect.</p>',
            'sort_order' => 3,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'Annual Reports',
            'slug' => 'annual-reports',
            'parent_id' => $pubs->id,
            'content' => '<p>Annual Reports provide a comprehensive overview of the Tribunal\'s activities, achievements, and financial performance during each financial year.</p>',
            'sort_order' => 4,
            'is_published' => true,
        ]);

        // Media Center Section
        $media = Page::create([
            'title' => 'Media Center',
            'slug' => 'media-center',
            'content' => '<p>Stay updated with the latest news, photos, and videos from the Fair Competition Tribunal.</p>',
            'sort_order' => 6,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'News',
            'slug' => 'news',
            'parent_id' => $media->id,
            'content' => '<p>Latest news and updates from the Fair Competition Tribunal.</p>',
            'sort_order' => 1,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'Photo Gallery',
            'slug' => 'photo-gallery',
            'parent_id' => $media->id,
            'content' => '<p>Browse photos from Tribunal events, hearings, and ceremonies.</p>',
            'sort_order' => 2,
            'is_published' => true,
        ]);

        Page::create([
            'title' => 'Video Gallery',
            'slug' => 'video-gallery',
            'parent_id' => $media->id,
            'content' => '<p>Watch videos from Tribunal proceedings, public events, and educational programs.</p>',
            'sort_order' => 3,
            'is_published' => true,
        ]);

        // Digital Case Filing
        Page::create([
            'title' => 'Digital Case Filing',
            'slug' => 'digital-case-filing',
            'content' => '<p>The Fair Competition Tribunal now offers digital case filing services. This system allows parties to file cases, submit documents, and track case progress online.</p><h3>How to Use Digital Case Filing</h3><ol><li>Register for an account on the e-filing portal</li><li>Complete the online case filing form</li><li>Upload all required documents in PDF format</li><li>Pay filing fees through the integrated payment system</li><li>Receive confirmation and case number</li></ol><p>For assistance with digital case filing, please contact the Tribunal Registry.</p>',
            'sort_order' => 7,
            'is_published' => true,
        ]);

        // Contact Us
        Page::create([
            'title' => 'Contact Us',
            'slug' => 'contact-us',
            'content' => '<p>For inquiries, please use the contact form or reach us through the following channels:</p>',
            'sort_order' => 8,
            'is_published' => true,
        ]);

        // Swahili titles (menu translation)
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
    }
}
