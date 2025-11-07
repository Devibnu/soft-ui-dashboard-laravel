<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AboutSection;

class AboutSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutSection::create([
            'tagline' => 'You Always Get the Best Guidance',
            'hero_title' => 'Our Journey Towards Excellence',
            'hero_subtitle' => '<p>We are committed to delivering exceptional services that exceed expectations. Our team of dedicated professionals brings years of experience and expertise to every project, ensuring the highest quality results.</p><p><strong>Our mission</strong> is to provide innovative solutions that drive success and create lasting value for our clients. Through continuous improvement and cutting-edge technology, we stay ahead of industry trends.</p>',
            'projects_completed' => 705,
            'satisfied_customers' => 809,
            'awards_received' => 335,
            'years_experience' => 35
        ]);
    }
}
