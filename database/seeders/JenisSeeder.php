<?php

namespace Database\Seeders;

use App\Models\Jenis;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jenis::truncate();
        $datas = [
            ['name' => 'Komputer'],
            ['name' => 'Kendaraan Kecil'],
            ['name' => 'Elektronik'],
            ['name' => 'AC'],
            ['name' => 'Kendaraan Besar'],
            ['name' => 'Mesin Produksi'],
            ['name' => 'Lainnya']
        ];
        foreach ($datas as $data) {
            Jenis::create($data);
        }
    }
}
