<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Video extends Model
{

    protected $fillable = [

        'judul',
        'youtube_url',
        'thumbnail',
        'status',

    ];

    protected $casts = [
        'status' => 'boolean',
    ];


}