<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSectionExtendedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\AboutSection::updateOrCreate(
            ['id' => 1],
            [
                'tagline' => 'Professional Consulting Services',
                'hero_title' => 'About JasaIbnu',
                'projects_completed' => 705,
                'satisfied_customers' => 809,
                'awards_received' => 335,
                'years_experience' => 35,
                'email' => 'info@jasaibnu.com',
                'phone' => '+62 812 3456 7890',
                'address' => 'Jl. Merdeka No. 123, Jakarta, Indonesia',
                'success_title' => 'Read Our Success Story for Inspiration',
                'success_description' => 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.',
                'welcome_title' => 'Welcome to JasaIbnu',
                'welcome_paragraph1' => 'JasaIbnu has been providing exceptional consulting services for over 35 years. We specialize in helping businesses achieve their goals through innovative solutions and strategic guidance.',
                'welcome_paragraph2' => 'Our team of experienced professionals is dedicated to delivering high-quality results that exceed our clients\' expectations. We work closely with each client to understand their unique needs and challenges.',
                'welcome_paragraph3' => 'From small startups to large corporations, we have helped hundreds of businesses transform their operations and achieve sustainable growth. Our proven track record speaks for itself.',
                'consultation_title' => 'We Are the Best Consulting Agency',
                'consultation_paragraph1' => 'Our comprehensive approach to business consulting ensures that every aspect of your organization is optimized for success. We provide strategic planning, operational improvement, and technology solutions.',
                'consultation_paragraph2' => 'With our deep industry expertise and innovative methodologies, we help businesses navigate complex challenges and seize new opportunities in today\'s competitive market.',
                'guidance_title' => 'You Always Get the Best Guidance',
                'video_url' => 'https://vimeo.com/45830194'
            ]
        );
    }
}
