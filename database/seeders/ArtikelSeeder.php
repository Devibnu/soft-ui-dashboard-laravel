<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Artikel;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $artikels = [
            [
                'judul' => 'Tips Memilih Jasa Digital Marketing Terpercaya',
                'slug' => 'tips-memilih-jasa-digital-marketing-terpercaya',
                'ringkasan' => 'Panduan lengkap untuk memilih jasa digital marketing yang tepat untuk bisnis Anda. Pelajari kriteria penting yang harus diperhatikan.',
                'isi' => '<h2>Pentingnya Digital Marketing untuk Bisnis</h2>
                         <p>Dalam era digital seperti sekarang ini, kehadiran online bisnis menjadi sangat penting. Digital marketing bukan lagi pilihan, melainkan kebutuhan yang wajib dipenuhi oleh setiap bisnis yang ingin berkembang dan bersaing di pasar.</p>
                         
                         <h3>Kriteria Jasa Digital Marketing Terpercaya</h3>
                         <p>Berikut adalah beberapa kriteria yang harus Anda perhatikan:</p>
                         <ul>
                         <li><strong>Portfolio yang Kuat:</strong> Periksa hasil kerja sebelumnya dan tingkat kepuasan klien</li>
                         <li><strong>Tim yang Berpengalaman:</strong> Pastikan memiliki tim ahli di berbagai bidang digital marketing</li>
                         <li><strong>Strategi yang Jelas:</strong> Memiliki rencana dan strategi yang terukur</li>
                         <li><strong>Transparansi Laporan:</strong> Memberikan laporan berkala yang mudah dipahami</li>
                         </ul>
                         
                         <h3>Layanan yang Harus Ditawarkan</h3>
                         <p>Jasa digital marketing terpercaya harus mampu menyediakan layanan lengkap seperti SEO, social media marketing, content marketing, dan paid advertising.</p>',
                'status' => 'aktif',
                'tanggal_dibuat' => now()->subDays(5),
                'tanggal_diperbarui' => now()->subDays(5)
            ],
            [
                'judul' => 'Strategi Social Media Marketing untuk UMKM',
                'slug' => 'strategi-social-media-marketing-untuk-umkm',
                'ringkasan' => 'Pelajari strategi efektif untuk memanfaatkan social media sebagai alat marketing yang powerful untuk UMKM dengan budget terbatas.',
                'isi' => '<h2>Mengapa UMKM Perlu Social Media Marketing?</h2>
                         <p>Social media marketing adalah salah satu cara paling cost-effective untuk UMKM dalam menjangkau target audience. Dengan biaya yang relatif rendah, UMKM bisa mendapatkan exposure yang luas.</p>
                         
                         <h3>Platform yang Tepat untuk UMKM</h3>
                         <p>Tidak semua platform cocok untuk setiap jenis bisnis. Berikut panduan memilih platform:</p>
                         <ul>
                         <li><strong>Instagram:</strong> Ideal untuk bisnis visual seperti fashion, food, dan lifestyle</li>
                         <li><strong>Facebook:</strong> Cocok untuk berbagai jenis bisnis dengan targeting yang detail</li>
                         <li><strong>TikTok:</strong> Efektif untuk brand yang ingin viral dan menjangkau Gen Z</li>
                         <li><strong>LinkedIn:</strong> Tepat untuk bisnis B2B dan professional services</li>
                         </ul>
                         
                         <h3>Tips Konten yang Engaging</h3>
                         <p>Buat konten yang memiliki value, konsisten, dan interaktif. Gunakan storytelling untuk membangun emotional connection dengan audience.</p>',
                'status' => 'aktif',
                'tanggal_dibuat' => now()->subDays(3),
                'tanggal_diperbarui' => now()->subDays(3)
            ],
            [
                'judul' => 'SEO untuk Pemula: Panduan Lengkap Optimasi Website',
                'slug' => 'seo-untuk-pemula-panduan-lengkap-optimasi-website',
                'ringkasan' => 'Pelajari dasar-dasar SEO dan teknik optimasi website yang dapat meningkatkan ranking di Google untuk pemula.',
                'isi' => '<h2>Apa itu SEO?</h2>
                         <p>Search Engine Optimization (SEO) adalah proses mengoptimalkan website agar mudah ditemukan oleh search engine seperti Google. Tujuannya adalah meningkatkan visibility dan organic traffic.</p>
                         
                         <h3>Komponen Utama SEO</h3>
                         <p>SEO terdiri dari beberapa komponen utama:</p>
                         <ol>
                         <li><strong>On-Page SEO:</strong> Optimasi di dalam website (content, meta tags, internal linking)</li>
                         <li><strong>Off-Page SEO:</strong> Optimasi di luar website (backlinks, social signals)</li>
                         <li><strong>Technical SEO:</strong> Optimasi teknis (site speed, mobile-friendly, schema markup)</li>
                         </ol>
                         
                         <h3>Langkah Awal untuk Pemula</h3>
                         <p>Mulai dengan riset keyword, optimasi judul dan meta description, serta pastikan website mobile-friendly dan loading dengan cepat.</p>
                         
                         <h3>Tools SEO yang Berguna</h3>
                         <p>Gunakan tools seperti Google Analytics, Google Search Console, dan tools keyword research untuk membantu optimasi website Anda.</p>',
                'status' => 'aktif',
                'tanggal_dibuat' => now()->subDays(1),
                'tanggal_diperbarui' => now()->subDays(1)
            ]
        ];

        foreach ($artikels as $artikel) {
            Artikel::create($artikel);
        }
    }
}
