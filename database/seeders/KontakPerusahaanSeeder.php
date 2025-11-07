<?php

namespace Database\Seeders;

use App\Models\KontakPerusahaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KontakPerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        KontakPerusahaan::updateOrCreate(
            ['id' => 1], // Find by ID
            [
                'judul_halaman' => 'Contact Us',
                'subjudul' => 'please do not hesitate to send us a message',
                'alamat' => '198 West 21th Street, Suite 721 New York NY 10016',
                'telepon' => '+1 235 2355 98',
                'email' => 'info@yoursite.com',
                'deskripsi_pesan' => 'If you got any questions please do not hesitate to send us a message',
                'map_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.2619894506213!2d-73.98965668459381!3d40.75889597932681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25855c6480299%3A0x55194ec5a1ae072e!2sTimes%20Square!5e0!3m2!1sen!2sus!4v1635724500000!5m2!1sen!2sus" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
                'nomor_whatsapp' => '6281234567890',
                'status_aktif' => true
            ]
        );
    }
}
