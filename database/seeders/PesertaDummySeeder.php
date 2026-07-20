<?php

namespace Database\Seeders;

use App\Models\OrangTua;
use App\Models\Peserta;
use App\Models\SekolahAsal;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PesertaDummySeeder extends Seeder
{
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'peserta@ppdb.test'],
            [
                'name' => 'Ahmad Rizki Pratama',
                'password' => Hash::make('password'),
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        $pesertaRole = Role::where('name', 'Peserta')->first();
        if ($pesertaRole && !$user->hasRole('Peserta')) {
            $user->assignRole('Peserta');
        }

        $peserta = Peserta::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nisn' => '0081234567',
                'nama_lengkap' => 'Ahmad Rizki Pratama',
                'tempat_lahir' => 'Makassar',
                'tanggal_lahir' => '2014-05-15',
                'jenis_kelamin' => 'L',
                'agama' => 'Islam',
                'no_hp' => '081234567890',
                'alamat' => 'Jl. Sudirman No. 123',
                'provinsi' => 'Sulawesi Selatan',
                'kabupaten' => 'Makassar',
                'kecamatan' => 'Panakkukang',
                'kelurahan' => 'Pandang-Pandang',
                'kode_pos' => '90231',
            ]
        );

        OrangTua::updateOrCreate(
            ['peserta_id' => $peserta->id],
            [
                'nama_ayah' => 'Budi Pratama',
                'pekerjaan_ayah' => 'PNS',
                'nama_ibu' => 'Siti Rahmawati',
                'pekerjaan_ibu' => 'Guru',
                'no_hp' => '081234567891',
            ]
        );

        SekolahAsal::updateOrCreate(
            ['peserta_id' => $peserta->id],
            [
                'nama_sekolah' => 'SDN 1 Makassar',
                'alamat' => 'Jl. Ahmad Yani No. 10',
            ]
        );
    }
}
