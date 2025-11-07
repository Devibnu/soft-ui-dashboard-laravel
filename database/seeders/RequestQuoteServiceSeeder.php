<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RequestQuoteService;
use Illuminate\Support\Str;

class RequestQuoteServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            'Web Development',
            'Mobile App Development',
            'Digital Marketing',
            'SEO Optimization',
            'Business Consulting',
            'UI/UX Design',
            'E-Commerce Solutions',
            'Cloud Services',
            'IT Support',
            'Other Services'
        ];

        foreach ($services as $service) {
            RequestQuoteService::create([
                'nama_service' => $service,
                'slug' => Str::slug($service),
                'status' => true
            ]);
        }
    }
}
