<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Seeder;

class PublisherSeeder extends Seeder
{
    public function run(): void
    {
        $publishers = [
            ['name' => 'Gramedia Pustaka Utama', 'address' => 'Jl. Palmerah Barat No. 29-37, Jakarta'],
            ['name' => 'Bentang Pustaka', 'address' => 'Jl. Plemburan No. 1, Sleman, Yogyakarta'],
            ['name' => 'Mizan', 'address' => 'Jl. Cinambo No. 135, Bandung'],
            ['name' => 'Balai Pustaka', 'address' => 'Jl. Gunung Sahari Raya No. 4, Jakarta'],
        ];

        foreach ($publishers as $publisher) {
            Publisher::create($publisher);
        }
    }
}