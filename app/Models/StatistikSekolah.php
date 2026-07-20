<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class StatistikSekolah extends Model
{

    protected $fillable=[

        'judul',
        'jumlah',
        'icon',
        'urutan',
        'is_aktif',

    ];


}