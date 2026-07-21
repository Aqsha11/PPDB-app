<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionSeeder extends Seeder
{

    public function run(): void
    {

        $permissions = [

            // Dashboard

            'dashboard.view',


            // Tahun Ajaran

            'tahun-ajaran.view',
            'tahun-ajaran.create',
            'tahun-ajaran.edit',
            'tahun-ajaran.delete',


            // Periode PPDB

            'periode.view',
            'periode.create',
            'periode.edit',
            'periode.delete',


            // Jalur

            'jalur.view',
            'jalur.create',
            'jalur.edit',
            'jalur.delete',


            // Dokumen

            'dokumen.view',
            'dokumen.create',
            'dokumen.edit',
            'dokumen.delete',


            // Pendaftaran

            'pendaftaran.view',
            'pendaftaran.verify',
            'pendaftaran.edit',
            'pendaftaran.delete',


            // Seleksi

            'seleksi.view',
            'seleksi.create',
            'seleksi.edit',
            'seleksi.delete',


            // Kelulusan

            'kelulusan.view',
            'kelulusan.publish',


            // CMS

            'cms.view',
            'cms.manage',


            // Berita

            'berita.view',
            'berita.create',
            'berita.edit',
            'berita.delete',


            // Pengumuman

            'pengumuman.view',
            'pengumuman.create',
            'pengumuman.edit',
            'pengumuman.delete',


            // User

            'user.view',
            'user.create',
            'user.edit',
            'user.delete',


            // Role

            'role.view',
            'role.create',
            'role.edit',
            'role.delete',


            // Report

            'laporan.view',
            'laporan.export',


            // Peserta (Biodata)

            'peserta.view',
            'peserta.edit',
            'peserta.delete',


        ];



        foreach($permissions as $permission)
        {

            Permission::firstOrCreate([
                'name'=>$permission,
                'guard_name'=>'web'
            ]);

        }


    }

}