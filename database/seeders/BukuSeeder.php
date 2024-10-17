<?php

namespace Database\Seeders;

use App\Models\Buku;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{

    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            Buku::create([
                'judul' => fake()->sentence(3),
                'penulis' => fake()->name(),
                'harga' => fake()->numberBetween(10000, 150000),
                'tanggal_terbit' => fake()->date(),
            ]);
        }
    }
}
