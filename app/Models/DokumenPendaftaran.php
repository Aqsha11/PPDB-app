<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DokumenPendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'pendaftaran_id',
        'persyaratan_dokumen_id',
        'file',
        'status',
        'catatan',
        'verified_at',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    public function persyaratanDokumen(): BelongsTo
    {
        return $this->belongsTo(PersyaratanDokumen::class);
    }
}