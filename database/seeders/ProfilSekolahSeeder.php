<?php

namespace Database\Seeders;

use App\Models\ProfilSekolah;
use Illuminate\Database\Seeder;

class ProfilSekolahSeeder extends Seeder
{
    public function run(): void
    {
        ProfilSekolah::updateOrCreate(['id' => 1], [
            'nama_sekolah' => 'SDN 1 Maju Makmur',
            'visi' => 'Mewujudkan peserta didik yang beriman, cerdas, kreatif, dan berkarakter mulia.',
            'misi' => 'Meningkatkan kualitas pembelajaran, mengembangkan bakat minat siswa, serta membina karakter yang unggul melalui program pendidikan yang inovatif dan berwawasan lingkungan.',
            'warna_primary' => '#2563EB',
            'warna_second' => '#7C3AED',
        ]);
    }
}
