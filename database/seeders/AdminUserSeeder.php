<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@ppdb.test',
                'role' => 'Super Admin',
            ],
            [
                'name' => 'Admin PPDB',
                'email' => 'admin@ppdb.test',
                'role' => 'Admin',
            ],
            [
                'name' => 'Operator',
                'email' => 'operator@ppdb.test',
                'role' => 'Operator',
            ],
            [
                'name' => 'Verifikator',
                'email' => 'verifikator@ppdb.test',
                'role' => 'Verifikator',
            ],
            [
                'name' => 'Siswa Test',
                'email' => 'siswa@ppdb.test',
                'role' => 'Siswa',
            ],
        ];

        foreach ($users as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password'),
                'is_active' => true,
                'email_verified_at' => now(),
            ]);
            $user->assignRole($data['role']);
        }

        $this->command->info('Admin and test users created successfully.');
    }
}
