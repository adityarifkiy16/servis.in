<?php

namespace Database\Seeders;

use App\Models\Departement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Departement::truncate();
        Departement::create(['name' => 'IT']);
        Departement::create(['name' => 'GA']);
        Departement::create(['name' => 'Marketing']);
        Departement::create(['name' => 'HRD']);
        Departement::create(['name' => 'Produksi']);
    }
}
