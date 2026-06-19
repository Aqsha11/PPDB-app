<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class HasilSeleksi extends Model
{

    protected $fillable = [

        'pendaftaran_id',
        'nilai',
        'peringkat',
        'status',
        'keterangan',

    ];


    protected $casts=[

        'nilai'=>'decimal:2'

    ];


    public function pendaftaran():BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }


}