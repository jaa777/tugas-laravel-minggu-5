<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            ['name' => 'Andrea Hirata', 'biography' => 'Penulis asal Belitung yang dikenal lewat novel Laskar Pelangi.', 'birth_date' => '1967-10-24'],
            ['name' => 'Pramoedya Ananta Toer', 'biography' => 'Sastrawan Indonesia, penulis Tetralogi Buru.', 'birth_date' => '1925-02-06'],
            ['name' => 'Tere Liye', 'biography' => 'Penulis novel populer Indonesia dengan puluhan judul.', 'birth_date' => '1979-05-21'],
            ['name' => 'Dee Lestari', 'biography' => 'Penulis dan penyanyi, pencipta serial Supernova.', 'birth_date' => '1976-01-20'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}