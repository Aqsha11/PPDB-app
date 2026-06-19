<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VerifikasiPendaftaran extends Model
{

    protected $fillable = [
        'pendaftaran_id',
        'verifikator_id',
        'status',
        'catatan',
        'tanggal_verifikasi',
    ];


    protected $casts = [
        'tanggal_verifikasi'=>'datetime',
    ];


    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }


    public function verifikator(): BelongsTo
    {
        return $this->belongsTo(User::class,'verifikator_id');
    }

}