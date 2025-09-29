<?php

namespace Database\Seeders;

use App\Models\Jenis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jenis::truncate();
        Jenis::create(['name' => 'Komputer']);
        Jenis::create(['name' => 'Kendaraan']);
        Jenis::create(['name' => 'Elektronik']);
    }
}
