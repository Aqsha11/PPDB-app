<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Pengumuman extends Model
{

    protected $table = 'pengumumans';

    protected $fillable=[

        'judul',
        'slug',
        'isi',
        'lampiran',
        'status',

    ];


    protected $casts=[

        'status'=>'boolean'

    ];

}