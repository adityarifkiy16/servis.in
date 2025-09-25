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
        $datas = [['name' => 'Elektronik'], ['name' => 'Otomotif']];
        foreach ($datas as $data) {
            Jenis::create($data);
        }
    }
}
