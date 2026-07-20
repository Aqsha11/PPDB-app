<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ProfilSekolah extends Model
{

    protected $fillable=[
        'nama_sekolah',
        'npsn',
        'logo',
        'foto_sekolah',
        'favicon',
        'visi',
        'misi',
        'sejarah',
        'deskripsi',
        'alamat',
        'kelurahan',
        'kecamatan',
        'kota',
        'provinsi',
        'kode_pos',
        'telepon',
        'whatsapp',
        'google_maps',
        'email',
        'warna_primary',
        'warna_second',
    ];

}