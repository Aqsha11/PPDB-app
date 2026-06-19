<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cache permission spatie
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = [
            'super-admin',
            'admin',
            'operator',
            'verifikator',
            'siswa',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Daftar permission dasar — akan bertambah seiring modul dibuat
        $permissions = [
            // Master Data
            'manage tahun ajaran',
            'manage periode ppdb',
            'manage jalur pendaftaran',
            'manage persyaratan dokumen',

            // CMS
            'manage cms',

            // Pendaftaran
            'view pendaftar',
            'verify pendaftar',
            'manage kelulusan',

            // Laporan
            'export laporan',

            // User Management
            'manage admin',
            'manage role',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign permission ke role
        Role::findByName('super-admin')->givePermissionTo(Permission::all());

        Role::findByName('admin')->givePermissionTo([
            'manage tahun ajaran',
            'manage periode ppdb',
            'manage jalur pendaftaran',
            'manage persyaratan dokumen',
            'manage cms',
            'view pendaftar',
            'manage kelulusan',
            'export laporan',
        ]);

        Role::findByName('operator')->givePermissionTo([
            'manage cms',
            'view pendaftar',
        ]);

        Role::findByName('verifikator')->givePermissionTo([
            'view pendaftar',
            'verify pendaftar',
        ]);

        // siswa tidak butuh permission backend, akses diatur via middleware role saja

        // Buat akun Super Admin default
        $superAdmin = \App\Models\User::firstOrCreate(
            ['email' => 'superadmin@ppdb.test'],
            [
                'name' => 'Super Admin',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->assignRole('super-admin');
    }
}