<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class HeroBanner extends Model
{

    protected $fillable=[

        'judul',
        'sub_judul',
        'deskripsi',
        'gambar',
        'button_text',
        'button_link',
        'urutan',
        'status',

    ];


    protected $casts=[

        'status'=>'boolean'

    ];


    public function scopeAktif($query)
    {
        return $query->where('status',true);
    }

}