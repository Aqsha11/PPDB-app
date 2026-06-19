<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{


    public function run(): void
    {


        $superAdmin = Role::firstOrCreate([
            'name'=>'Super Admin'
        ]);



        $admin = Role::firstOrCreate([
            'name'=>'Admin'
        ]);



        $operator = Role::firstOrCreate([
            'name'=>'Operator'
        ]);



        $verifikator = Role::firstOrCreate([
            'name'=>'Verifikator'
        ]);



        $siswa = Role::firstOrCreate([
            'name'=>'Siswa'
        ]);




        // Super Admin semua akses

        $superAdmin
            ->syncPermissions(
                Permission::all()
            );



        // Admin

        $admin->syncPermissions([

            'dashboard.view',

            'tahun-ajaran.view',
            'tahun-ajaran.create',
            'tahun-ajaran.edit',
            'tahun-ajaran.delete',

            'periode.view',
            'periode.create',
            'periode.edit',
            'periode.delete',

            'jalur.view',
            'jalur.create',
            'jalur.edit',

            'pendaftaran.view',
            'pendaftaran.verify',

            'cms.manage',

            'laporan.view',
            'laporan.export',

        ]);




        // Operator

        $operator->syncPermissions([

            'dashboard.view',

            'pendaftaran.view',

            'dokumen.view',

            'berita.view',
            'berita.create',
            'berita.edit',

        ]);





        // Verifikator

        $verifikator->syncPermissions([

            'dashboard.view',

            'pendaftaran.view',

            'pendaftaran.verify',

            'dokumen.view',

        ]);





        // Siswa

        $siswa->syncPermissions([

            'dashboard.view'

        ]);



    }

}