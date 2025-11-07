<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@email.com',
                'subject' => 'Pertanyaan tentang layanan web development',
                'message' => 'Halo, saya ingin menanyakan tentang layanan pembuatan website e-commerce. Berapa estimasi biaya dan waktu pengerjaannya? Terima kasih.',
                'status' => 'baru',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@gmail.com',
                'subject' => 'Konsultasi project mobile app',
                'message' => 'Selamat siang, saya berencana membuat aplikasi mobile untuk bisnis saya. Apakah ada paket konsultasi gratis? Mohon informasinya.',
                'status' => 'dibaca',
                'read_at' => now()->subDay(),
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDay(),
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@company.co.id',
                'subject' => 'Follow up project landing page',
                'message' => 'Terima kasih atas reply email sebelumnya. Kami sudah diskusi internal dan tertarik untuk melanjutkan project ini. Kapan bisa kita meeting online?',
                'status' => 'selesai',
                'read_at' => now()->subDays(7),
                'created_at' => now()->subDays(8),
                'updated_at' => now()->subDays(7),
            ],
            [
                'name' => 'Lisa Wijaya',
                'email' => 'lisa.wijaya@startup.id',
                'subject' => 'Permintaan portofolio dan harga',
                'message' => 'Hi, kami dari startup teknologi mencari partner untuk develop dashboard analytics. Bisa minta portfolio project sejenis dan price list? Thanks!',
                'status' => 'baru',
                'created_at' => now()->subHours(5),
                'updated_at' => now()->subHours(5),
            ],
            [
                'name' => 'Doni Pratama',
                'email' => 'doni.pratama@outlook.com',
                'subject' => 'Maintenance website existing',
                'message' => 'Pak, website saya yang lama butuh maintenance dan update. Apakah JasaIbnu melayani maintenance website yang dibuat pihak lain? Terima kasih.',
                'status' => 'baru',
                'created_at' => now()->subMinutes(30),
                'updated_at' => now()->subMinutes(30),
            ],
        ];

        foreach ($messages as $message) {
            \App\Models\ContactMessage::create($message);
        }
    }
}
