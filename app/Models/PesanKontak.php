<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesanKontak extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'subjek',
        'pesan',
        'is_read',
    ];
}
