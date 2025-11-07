<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FooterSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\FooterSetting::create([
            'alamat' => '203 Fake St. Mountain View, San Francisco, California, USA',
            'telepon' => '+2 392 3929 210',
            'email' => 'info@jasaibnu.id',
            'placeholder_subscribe' => 'Enter email address',
            'tombol_subscribe_text' => 'Subscribe',
            'tombol_subscribe_link' => '#',
            'facebook_link' => 'https://facebook.com',
            'twitter_link' => 'https://twitter.com',
            'instagram_link' => 'https://instagram.com',
            'linkedin_link' => null,
            'youtube_link' => null,
            'copyright_text' => 'Copyright &copy; ' . date('Y') . ' All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>'
        ]);
    }
}
