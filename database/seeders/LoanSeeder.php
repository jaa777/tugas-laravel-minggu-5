<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    public function run(): void
    {
        $member = fn (string $name) => Member::where('name', $name)->firstOrFail()->id;
        $book = fn (string $title) => Book::where('title', $title)->firstOrFail()->id;

        // [anggota, buku, hari lalu dipinjam, hari lalu dikembalikan (null = belum)]
        $loans = [
            ['Budi Santoso',   'Laskar Pelangi',    30, 20],
            ['Siti Rahmawati', 'Bumi Manusia',      25, 15],
            ['Andi Pratama',   'Pulang',            10, null],
            ['Dewi Lestari',   'Filosofi Kopi',     21, null], // sudah lewat jatuh tempo
            ['Rizky Hasibuan', 'Bumi',              5,  null],
            ['Budi Santoso',   'Sang Pemimpi',      3,  null],
        ];

        foreach ($loans as [$memberName, $title, $borrowedDaysAgo, $returnedDaysAgo]) {
            $loanDate = now()->subDays($borrowedDaysAgo)->toDateString();

            Loan::create([
                'member_id' => $member($memberName),
                'book_id' => $book($title),
                'loan_date' => $loanDate,
                'due_date' => now()->subDays($borrowedDaysAgo)->addDays(14)->toDateString(),
                'return_date' => $returnedDaysAgo !== null ? now()->subDays($returnedDaysAgo)->toDateString() : null,
                'status' => $returnedDaysAgo !== null ? 'returned' : 'borrowed',
            ]);
        }
    }
}