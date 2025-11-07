<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            [
                'nama' => 'Digital Marketing',
                'slug' => 'digital-marketing',
                'deskripsi' => 'Artikel tentang strategi dan tips digital marketing',
                'warna' => '#3b82f6',
                'urutan' => 1,
                'status' => 'aktif'
            ],
            [
                'nama' => 'SEO',
                'slug' => 'seo',
                'deskripsi' => 'Tips dan trik optimasi mesin pencari',
                'warna' => '#10b981',
                'urutan' => 2,
                'status' => 'aktif'
            ],
            [
                'nama' => 'Social Media',
                'slug' => 'social-media',
                'deskripsi' => 'Strategi pemasaran media sosial',
                'warna' => '#8b5cf6',
                'urutan' => 3,
                'status' => 'aktif'
            ],
            [
                'nama' => 'Content Marketing',
                'slug' => 'content-marketing',
                'deskripsi' => 'Panduan membuat konten marketing yang efektif',
                'warna' => '#f59e0b',
                'urutan' => 4,
                'status' => 'aktif'
            ],
            [
                'nama' => 'Web Development',
                'slug' => 'web-development',
                'deskripsi' => 'Artikel tentang pengembangan website',
                'warna' => '#ef4444',
                'urutan' => 5,
                'status' => 'aktif'
            ],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::updateOrCreate(
                ['slug' => $kategori['slug']],
                $kategori
            );
        }
    }
}
