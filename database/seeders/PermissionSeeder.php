<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::truncate();
        $permissions = [
            ['name' => 'management_users'], // Admin
            ['name' => 'management_roles'], // Admin
            ['name' => 'management_service'], // Admin, PIC, Teknisi
            ['name' => 'management_product'],
            ['name' => 'management_departement'],
            ['name' => 'update_status'],
            ['name' => 'download_report'],

        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
