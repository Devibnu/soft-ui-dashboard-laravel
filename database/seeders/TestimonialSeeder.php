<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'Henry Dee',
                'role' => 'CEO & Founder',
                'message' => 'Outstanding service! The team delivered exactly what we needed on time and within budget. Their attention to detail and professionalism is unmatched.',
                'image' => null
            ],
            [
                'name' => 'Mark Huff',
                'role' => 'Project Manager',
                'message' => 'Working with this team has been a game-changer for our business. Their innovative approach and technical expertise helped us achieve our goals faster than expected.',
                'image' => null
            ],
            [
                'name' => 'Rodel Golez',
                'role' => 'Business Analyst',
                'message' => 'Exceptional quality and customer service. They understood our requirements perfectly and delivered a solution that exceeded our expectations. Highly recommended!',
                'image' => null
            ]
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
