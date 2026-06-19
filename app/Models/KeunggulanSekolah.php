<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class KeunggulanSekolah extends Model
{

    protected $fillable=[

        'judul',
        'deskripsi',
        'icon',
        'gambar',
        'urutan',

    ];

}