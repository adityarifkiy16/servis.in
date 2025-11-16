<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan data lama
        Permission::truncate();
        Role::truncate();

        // Permissions
        $permissions = [
            ['name' => 'management_users'],
            ['name' => 'management_roles'],
            ['name' => 'management_service'],
            ['name' => 'management_product'],
            ['name' => 'management_departement'],
            ['name' => 'update_status'],
            ['name' => 'download_report'],
            ['name' => 'management_jenis'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Roles
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'PIC'],
            ['name' => 'Teknisi'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        // Ambil role dan permission
        $admin   = Role::where('name', 'Admin')->first();
        $pic     = Role::where('name', 'PIC')->first();
        $teknisi = Role::where('name', 'Teknisi')->first();

        $allPermissions = Permission::all();

        // Assign permission ke role
        $admin->permissions()->sync($allPermissions->pluck('id')); // Admin punya semua
        $pic->permissions()->sync(
            Permission::whereIn('name', ['management_service', 'management_product', 'download_report', 'management_jenis'])->pluck('id')
        );
        $teknisi->permissions()->sync(
            Permission::whereIn('name', ['management_service', 'update_status', 'download_report'])->pluck('id')
        );

        // Buat user admin
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
                'role_id' => $admin->id, // langsung isi role_id
            ]
        );
    }
}
