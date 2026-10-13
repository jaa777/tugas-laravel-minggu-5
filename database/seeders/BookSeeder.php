<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $author = fn (string $name) => Author::where('name', $name)->firstOrFail()->id;
        $publisher = fn (string $name) => Publisher::where('name', $name)->firstOrFail()->id;

        $books = [
            ['Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 'Novel', '978-979-3062-79-1', 2005, 5],
            ['Sang Pemimpi', 'Andrea Hirata', 'Bentang Pustaka', 'Novel', '978-979-3062-92-0', 2006, 6],
            ['Bumi Manusia', 'Pramoedya Ananta Toer', 'Balai Pustaka', 'Novel', '978-979-9731-23-4', 1980, 3],
            ['Anak Semua Bangsa', 'Pramoedya Ananta Toer', 'Balai Pustaka', 'Novel', '978-979-9731-24-1', 1980, 2],
            ['Pulang', 'Tere Liye', 'Gramedia Pustaka Utama', 'Novel', '978-602-8997-77-1', 2015, 4],
            ['Bumi', 'Tere Liye', 'Gramedia Pustaka Utama', 'Fantasi', '978-602-03-3295-6', 2014, 7],
            ['Supernova: Ksatria, Puteri, dan Bintang Jatuh', 'Dee Lestari', 'Mizan', 'Fiksi', '978-979-1032-11-2', 2001, 2],
            ['Filosofi Kopi', 'Dee Lestari', 'Mizan', 'Kumpulan Cerpen', '978-979-1032-45-7', 2006, 3],
        ];

        foreach ($books as [$title, $authorName, $publisherName, $category, $isbn, $year, $stock]) {
            Book::create([
                'author_id' => $author($authorName),
                'publisher_id' => $publisher($publisherName),
                'title' => $title,
                'category' => $category,
                'isbn' => $isbn,
                'publication_year' => $year,
                'stock' => $stock,
            ]);
        }
    }
}