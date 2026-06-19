<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Partner extends Model
{

    protected $fillable=[

        'nama',
        'logo',
        'website',
        'urutan',
        'status',

    ];


    protected $casts=[

        'status'=>'boolean'

    ];


}