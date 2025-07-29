<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kabupaten;

class kabupatenseed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kabupaten::create([
            'nama_kabupaten' => 'Bandung',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Kabupaten::create([
            'nama_kabupaten' => 'Garut',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Kabupaten::create([
            'nama_kabupaten' => 'Tasik',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
