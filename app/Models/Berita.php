<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Berita extends Model
{

    protected $fillable=[

        'judul',
        'slug',
        'thumbnail',
        'konten',
        'status',
        'published_at',

    ];


    protected $casts=[

        'status'=>'boolean',
        'published_at'=>'datetime',

    ];


    public function scopePublish($query)
    {

        return $query
        ->where('status',true)
        ->whereNotNull('published_at');

    }

}