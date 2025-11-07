<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proyek;
use Carbon\Carbon;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'judul' => 'Website E-Commerce Fashion Terkini',
                'kategori' => 'Web Development',
                'deskripsi_singkat' => 'Platform e-commerce modern untuk brand fashion lokal dengan fitur lengkap shopping cart, payment gateway, dan inventory management.',
                'deskripsi_lengkap' => '<h2>Overview</h2><p>Kami mengembangkan platform e-commerce yang powerful dan user-friendly untuk brand fashion lokal. Website ini dilengkapi dengan fitur modern seperti shopping cart, multiple payment gateway, inventory management, dan dashboard analytics.</p><h3>Fitur Utama:</h3><ul><li>Responsive design untuk semua device</li><li>Integration dengan payment gateway</li><li>Real-time inventory tracking</li><li>Customer dashboard</li><li>Admin panel yang comprehensive</li></ul>',
                'gambar_utama' => 'projects/ecommerce-main.jpg',
                'galeri' => [
                    'projects/gallery/ecommerce-1.jpg',
                    'projects/gallery/ecommerce-2.jpg',
                    'projects/gallery/ecommerce-3.jpg'
                ],
                'klien' => 'Fashion Nusantara',
                'lokasi' => 'Jakarta, Indonesia',
                'tanggal_proyek' => Carbon::create(2024, 3, 15),
                'status' => true
            ],
            [
                'judul' => 'Mobile App Delivery Food',
                'kategori' => 'Mobile App',
                'deskripsi_singkat' => 'Aplikasi mobile delivery makanan dengan teknologi GPS tracking, real-time order updates, dan multiple restaurant integration.',
                'deskripsi_lengkap' => '<h2>Project Description</h2><p>Aplikasi mobile food delivery yang menghubungkan pelanggan dengan berbagai restoran lokal. Dilengkapi dengan GPS tracking untuk real-time delivery updates dan payment integration.</p><h3>Technology Stack:</h3><ul><li>React Native for mobile development</li><li>Firebase for backend</li><li>Google Maps API</li><li>Stripe payment integration</li></ul>',
                'gambar_utama' => 'projects/food-delivery-main.jpg',
                'galeri' => [
                    'projects/gallery/food-1.jpg',
                    'projects/gallery/food-2.jpg'
                ],
                'klien' => 'FoodHub Indonesia',
                'lokasi' => 'Bandung, Indonesia',
                'tanggal_proyek' => Carbon::create(2024, 5, 20),
                'status' => true
            ],
            [
                'judul' => 'Corporate Website & Branding',
                'kategori' => 'Branding',
                'deskripsi_singkat' => 'Complete branding package termasuk logo design, website corporate, dan marketing collateral untuk perusahaan teknologi.',
                'deskripsi_lengkap' => '<h2>Branding Project</h2><p>Kami merancang complete branding identity untuk startup teknologi, mulai dari logo design, color palette, typography, hingga website corporate yang profesional.</p><h3>Deliverables:</h3><ul><li>Logo design dan brand guidelines</li><li>Corporate website</li><li>Business cards dan stationery</li><li>Marketing materials</li><li>Social media templates</li></ul>',
                'gambar_utama' => 'projects/branding-main.jpg',
                'galeri' => [
                    'projects/gallery/branding-1.jpg',
                    'projects/gallery/branding-2.jpg',
                    'projects/gallery/branding-3.jpg',
                    'projects/gallery/branding-4.jpg'
                ],
                'klien' => 'TechStart Solutions',
                'lokasi' => 'Surabaya, Indonesia',
                'tanggal_proyek' => Carbon::create(2024, 2, 10),
                'status' => true
            ],
            [
                'judul' => 'Dashboard Analytics untuk SaaS',
                'kategori' => 'UI/UX Design',
                'deskripsi_singkat' => 'User interface design untuk dashboard analytics SaaS platform dengan focus pada data visualization dan user experience.',
                'deskripsi_lengkap' => '<h2>UI/UX Design Project</h2><p>Merancang interface dashboard analytics yang intuitif dan powerful untuk SaaS platform. Focus utama adalah membuat data visualization yang mudah dipahami dan actionable insights.</p><h3>Design Process:</h3><ul><li>User research dan competitive analysis</li><li>Wireframing dan prototyping</li><li>High-fidelity design</li><li>Usability testing</li><li>Design handoff untuk development</li></ul>',
                'gambar_utama' => 'projects/dashboard-main.jpg',
                'galeri' => [
                    'projects/gallery/dashboard-1.jpg',
                    'projects/gallery/dashboard-2.jpg'
                ],
                'klien' => 'DataMetrics Pro',
                'lokasi' => 'Singapore',
                'tanggal_proyek' => Carbon::create(2024, 6, 5),
                'status' => true
            ],
            [
                'judul' => 'Digital Marketing Campaign',
                'kategori' => 'Digital Marketing',
                'deskripsi_singkat' => 'Integrated digital marketing campaign untuk product launch dengan focus pada social media, content marketing, dan paid advertising.',
                'deskripsi_lengkap' => '<h2>Marketing Campaign</h2><p>Campaign digital marketing terintegrasi untuk product launch, meliputi strategi content, social media management, paid advertising, dan influencer collaboration.</p><h3>Campaign Strategy:</h3><ul><li>Social media content planning</li><li>Facebook & Instagram Ads</li><li>Google Ads campaign</li><li>Influencer marketing</li><li>Email marketing automation</li></ul><h3>Results:</h3><ul><li>150% increase in social media engagement</li><li>200K+ reach dalam 1 bulan</li><li>50+ new customers acquired</li></ul>',
                'gambar_utama' => 'projects/marketing-main.jpg',
                'galeri' => [
                    'projects/gallery/marketing-1.jpg',
                    'projects/gallery/marketing-2.jpg',
                    'projects/gallery/marketing-3.jpg'
                ],
                'klien' => 'BeautyGlow Cosmetics',
                'lokasi' => 'Jakarta, Indonesia',
                'tanggal_proyek' => Carbon::create(2024, 4, 25),
                'status' => true
            ]
        ];

        foreach ($projects as $project) {
            Proyek::create($project);
        }
    }
}
