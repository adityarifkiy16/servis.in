<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama
        Permission::truncate();
        Role::truncate();

        // List permissions
        $permissions = [
            ['name' => 'management_users'],      // Admin
            ['name' => 'management_roles'],      // Admin
            ['name' => 'management_service'],    // Admin, PIC, Teknisi
            ['name' => 'management_product'],
            ['name' => 'management_departement'],
            ['name' => 'update_status'],
            ['name' => 'download_report'],
        ];

        // List roles
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'PIC'],
            ['name' => 'Teknisi'],
        ];

        // Insert roles
        foreach ($roles as $role) {
            Role::create($role);
        }

        // Insert permissions
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Ambil ulang role dan permission
        $admin   = Role::where('name', 'Admin')->first();
        $pic     = Role::where('name', 'PIC')->first();
        $teknisi = Role::where('name', 'Teknisi')->first();

        $allPermissions = Permission::all();

        // Hubungkan permission ke role via pivot
        $admin->permissions()->sync($allPermissions->pluck('id')); // Admin punya semua

        $pic->permissions()->sync(
            Permission::where('name', 'management_service')->pluck('id')
        );

        $teknisi->permissions()->sync(
            Permission::whereIn('name', ['management_service', 'update_status'])->pluck('id')
        );

        // Buat user admin default
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'), // ganti sesuai kebutuhan
            ],
            ['role_id' => $admin->id]
        );

        // Assign role admin ke user
    }
}
