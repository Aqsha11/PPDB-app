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



        $peserta = Role::firstOrCreate([
            'name'=>'Peserta'
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

            'dokumen.view',

            'cms.manage',

            'laporan.view',
            'laporan.export',

            'user.view',
            'user.create',
            'user.edit',
            'user.delete',

            'role.view',
            'role.edit',

            'peserta.view',
            'peserta.edit',
            'peserta.delete',

        ]);




        // Operator

        $operator->syncPermissions([

            'dashboard.view',

            'pendaftaran.view',

            'dokumen.view',

            'berita.view',
            'berita.create',
            'berita.edit',

            'peserta.view',

        ]);





        // Verifikator

        $verifikator->syncPermissions([

            'dashboard.view',

            'pendaftaran.view',

            'pendaftaran.verify',

            'dokumen.view',

        ]);





        // Peserta

        $peserta->syncPermissions([

            'dashboard.view'

        ]);



    }

}