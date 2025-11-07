<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutNewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Hero Section
        \App\Models\AboutHeroSection::create([
            'tagline' => 'Professional IT Solutions & Digital Services',
            'projects_completed' => 705,
            'satisfied_customers' => 809,
            'awards_received' => 335,
            'years_experience' => 35
        ]);

        // Create Content Section
        \App\Models\AboutContentSection::create([
            'title' => 'Welcome to JasaIbnu',
            'left_paragraph' => 'JasaIbnu telah menjadi mitra terpercaya dalam menyediakan solusi IT dan layanan digital selama lebih dari 35 tahun. Kami mengspecialisasikan diri dalam membantu bisnis mencapai tujuan mereka melalui inovasi teknologi dan strategi digital yang tepat sasaran.',
            'right_title' => 'Read Our Success Story for Inspiration',
            'right_paragraph' => 'Dari startup kecil hingga korporasi besar, kami telah membantu ratusan klien mentransformasi operasi bisnis mereka dan mencapai pertumbuhan yang berkelanjutan. Track record kami berbicara sendiri tentang komitmen kami terhadap excellence.',
            'cta_text' => 'Contact Us',
            'cta_link' => 'https://jasaibnu.id/contact',
            'is_active' => true
        ]);

        // Create sample testimonials
        $testimonials = [
            [
                'section_title' => 'Our Clients Say',
                'section_subtext' => 'Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.',
                'name' => 'Racky Henderson',
                'position' => 'CEO, TechCorp Indonesia',
                'message' => 'JasaIbnu telah menjadi partner strategis kami selama 5 tahun terakhir. Mereka tidak hanya menyediakan solusi teknis yang excellent, tetapi juga understanding yang mendalam tentang business requirement kami.',
                'is_active' => true
            ],
            [
                'section_title' => 'Our Clients Say',
                'section_subtext' => 'Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.',
                'name' => 'Henry Dee',
                'position' => 'CTO, Digital Solutions Ltd',
                'message' => 'Profesionalisme dan expertise tim JasaIbnu sangat membantu dalam digital transformation journey perusahaan kami. Highly recommended untuk semua kebutuhan IT solutions.',
                'is_active' => true
            ],
            [
                'section_title' => 'Our Clients Say',
                'section_subtext' => 'Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean. A small river named Duden flows by their place and supplies it with the necessary regelialia.',
                'name' => 'Mark Huff',
                'position' => 'Founder, StartupABC',
                'message' => 'Sebagai startup, kami membutuhkan partner yang bisa understand vision kami dan provide scalable solutions. JasaIbnu terbukti menjadi pilihan yang tepat sejak hari pertama.',
                'is_active' => true
            ]
        ];

        foreach ($testimonials as $testimonial) {
            \App\Models\AboutTestimonialSection::create($testimonial);
        }
    }
}
