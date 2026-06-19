<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class JadwalPpdb extends Model
{

    protected $fillable=[

        'kegiatan',
        'tanggal_mulai',
        'tanggal_selesai',
        'deskripsi',
        'urutan',

    ];


    protected $casts=[

        'tanggal_mulai'=>'date',
        'tanggal_selesai'=>'date',

    ];

}