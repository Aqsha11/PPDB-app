<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class MediaSosial extends Model
{

    protected $fillable=[

        'platform',
        'icon',
        'url',
        'urutan',
        'status',

    ];


    protected $casts=[

        'status'=>'boolean'

    ];


}