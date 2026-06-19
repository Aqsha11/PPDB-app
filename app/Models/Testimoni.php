<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Testimoni extends Model
{

    protected $fillable=[

        'nama',
        'foto',
        'isi',
        'angkatan',
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