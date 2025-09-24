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
        $permissions = [
            ['name' => 'management_users'], // Admin
            ['name' => 'management_roles'], // Admin
            ['name' => 'report_service'], // Admin, PIC, Teknisi
            ['name' => 'request_service'], // Admin, PIC, Teknisi
            ['name' => 'management_product'], // Admin, PIC
            ['name' => 'management_service'], // Admin, Teknisi
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
