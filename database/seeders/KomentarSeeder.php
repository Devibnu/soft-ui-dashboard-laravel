<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Komentar;
use App\Models\Artikel;

class KomentarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artikel1 = Artikel::where('slug', 'tips-memilih-jasa-digital-marketing-terpercaya')->first();
        $artikel2 = Artikel::where('slug', 'strategi-social-media-marketing-untuk-umkm')->first();
        $artikel3 = Artikel::where('slug', 'seo-untuk-pemula-panduan-lengkap-optimasi-website')->first();

        if ($artikel1) {
            // Komentar untuk artikel 1
            $komentar1 = Komentar::create([
                'artikel_id' => $artikel1->id,
                'nama' => 'Budi Santoso',
                'email' => 'budi@gmail.com',
                'isi' => 'Artikel yang sangat bermanfaat! Saya sebagai pemilik UMKM merasa terbantu dengan tips-tips yang diberikan. Terima kasih sudah berbagi informasi yang valuable.',
                'status' => 'disetujui',
                'tanggal_dibuat' => now()->subDays(4)
            ]);

            // Balasan admin untuk komentar 1
            Komentar::create([
                'artikel_id' => $artikel1->id,
                'nama' => 'Admin',
                'email' => 'admin@jasaibnu.id',
                'isi' => 'Terima kasih atas feedbacknya, Pak Budi. Senang mendengar artikel ini bermanfaat untuk UMKM. Jangan ragu untuk konsultasi lebih lanjut jika membutuhkan bantuan digital marketing.',
                'status' => 'disetujui',
                'parent_id' => $komentar1->id,
                'tanggal_dibuat' => now()->subDays(4)
            ]);

            Komentar::create([
                'artikel_id' => $artikel1->id,
                'nama' => 'Sari Dewi',
                'email' => 'sari.dewi@yahoo.com',
                'isi' => 'Sangat membantu untuk saya yang baru memulai bisnis online. Kriteria-kriteria yang disebutkan akan saya jadikan panduan dalam memilih jasa digital marketing.',
                'status' => 'disetujui',
                'tanggal_dibuat' => now()->subDays(3)
            ]);
        }

        if ($artikel2) {
            // Komentar untuk artikel 2
            $komentar2 = Komentar::create([
                'artikel_id' => $artikel2->id,
                'nama' => 'Indra Pratama',
                'email' => 'indra.pratama@gmail.com',
                'isi' => 'Platform mana yang paling efektif untuk bisnis kuliner? Saya punya warung makan dan ingin mulai promosi di social media.',
                'status' => 'disetujui',
                'tanggal_dibuat' => now()->subDays(2)
            ]);

            // Balasan admin untuk komentar 2
            Komentar::create([
                'artikel_id' => $artikel2->id,
                'nama' => 'Admin',
                'email' => 'admin@jasaibnu.id',
                'isi' => 'Untuk bisnis kuliner, Instagram dan TikTok sangat efektif karena visual makanan bisa menarik perhatian. Facebook juga bagus untuk targeting lokal. Kombinasikan ketiganya untuk hasil maksimal.',
                'status' => 'disetujui',
                'parent_id' => $komentar2->id,
                'tanggal_dibuat' => now()->subDays(2)
            ]);

            Komentar::create([
                'artikel_id' => $artikel2->id,
                'nama' => 'Maya Sari',
                'email' => 'maya@gmail.com',
                'isi' => 'Kontennya sangat praktis dan mudah dipahami. Sudah mulai menerapkan beberapa tips dan hasilnya cukup memuaskan!',
                'status' => 'pending',
                'tanggal_dibuat' => now()->subDays(1)
            ]);
        }

        if ($artikel3) {
            // Komentar untuk artikel 3
            Komentar::create([
                'artikel_id' => $artikel3->id,
                'nama' => 'Rizki Ahmad',
                'email' => 'rizki.ahmad@gmail.com',
                'isi' => 'Sebagai pemula di dunia SEO, artikel ini sangat membantu memahami konsep dasar. Tools yang disebutkan juga akan saya coba.',
                'status' => 'disetujui',
                'tanggal_dibuat' => now()->subHours(12)
            ]);

            Komentar::create([
                'artikel_id' => $artikel3->id,
                'nama' => 'Linda Kusuma',
                'email' => 'linda@yahoo.com',
                'isi' => 'Bisakah dijelaskan lebih detail tentang technical SEO? Sepertinya bagian itu yang paling rumit untuk dipahami.',
                'status' => 'pending',
                'tanggal_dibuat' => now()->subHours(6)
            ]);
        }
    }
}
