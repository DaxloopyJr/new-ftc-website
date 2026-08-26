<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamMemberSeeder extends Seeder
{
    public function run(): void
    {
        TeamMember::create([
            'name' => 'Hon. Dr. John Mwakyusa',
            'title' => 'Chairperson',
            'designation' => 'Chairperson of the Fair Competition Tribunal',
            'bio' => 'Hon. Dr. John Mwakyusa was appointed as Chairperson of the Fair Competition Tribunal in 2022. He holds a PhD in Law from the University of Dar es Salaam and has over 25 years of experience in legal practice and judicial service.',
            'photo' => null,
            'category' => 'tribunal_member',
            'email' => 'chairperson@fct.go.tz',
            'phone' => '+255 22 2123457',
            'display_order' => 1,
            'is_active' => true,
        ]);

        TeamMember::create([
            'name' => 'Hon. Mary Shayo',
            'title' => 'Member',
            'designation' => 'Tribunal Member',
            'bio' => 'Hon. Mary Shayo brings extensive experience in competition law and economics. She previously served as Senior Legal Counsel at the Fair Competition Commission.',
            'photo' => null,
            'category' => 'tribunal_member',
            'email' => 'm.shayo@fct.go.tz',
            'phone' => '+255 22 2123458',
            'display_order' => 2,
            'is_active' => true,
        ]);

        TeamMember::create([
            'name' => 'Hon. Prof. Abel Kinyondo',
            'title' => 'Member',
            'designation' => 'Tribunal Member',
            'bio' => 'Hon. Prof. Abel Kinyondo is a distinguished economist with expertise in industrial organization and competition policy. He is a professor at the University of Dar es Salaam.',
            'photo' => null,
            'category' => 'tribunal_member',
            'email' => 'a.kinyondo@fct.go.tz',
            'phone' => '+255 22 2123459',
            'display_order' => 3,
            'is_active' => true,
        ]);

        TeamMember::create([
            'name' => 'Ms. Rosemary Kileo',
            'title' => 'Registrar',
            'designation' => 'Registrar of the Fair Competition Tribunal',
            'bio' => 'Ms. Rosemary Kileo serves as the Registrar of the Fair Competition Tribunal, overseeing all administrative and registry functions. She has over 15 years of experience in court administration.',
            'photo' => null,
            'category' => 'management',
            'email' => 'registrar@fct.go.tz',
            'phone' => '+255 22 2123460',
            'display_order' => 4,
            'is_active' => true,
        ]);

        TeamMember::create([
            'name' => 'Mr. Joseph Msuya',
            'title' => 'Deputy Registrar',
            'designation' => 'Deputy Registrar',
            'bio' => 'Mr. Joseph Msuya assists the Registrar in managing Tribunal operations and serves as the head of the Research and Publications Unit.',
            'photo' => null,
            'category' => 'management',
            'email' => 'j.msuya@fct.go.tz',
            'phone' => '+255 22 2123461',
            'display_order' => 5,
            'is_active' => true,
        ]);

        TeamMember::create([
            'name' => 'Ms. Anna Temu',
            'title' => 'Head of Finance',
            'designation' => 'Head of Finance and Administration',
            'bio' => 'Ms. Anna Temu manages the Tribunal\'s financial operations, budgeting, and administrative functions.',
            'photo' => null,
            'category' => 'management',
            'email' => 'a.temu@fct.go.tz',
            'phone' => '+255 22 2123462',
            'display_order' => 6,
            'is_active' => true,
        ]);
    }
}
