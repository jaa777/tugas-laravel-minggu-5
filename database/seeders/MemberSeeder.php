<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    public function run(): void
    {
        $members = [
            ['name' => 'Budi Santoso', 'address' => 'Jl. Gatot Subroto No. 12, Medan'],
            ['name' => 'Siti Rahmawati', 'address' => 'Jl. Sisingamangaraja No. 45, Medan'],
            ['name' => 'Andi Pratama', 'address' => 'Jl. Setia Budi No. 8, Medan'],
            ['name' => 'Dewi Lestari', 'address' => 'Jl. Karya Wisata No. 21, Medan'],
            ['name' => 'Rizky Hasibuan', 'address' => 'Jl. Ringroad No. 3, Medan'],
        ];

        foreach ($members as $member) {
            Member::create($member);
        }
    }
}