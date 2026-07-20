<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PersyaratanDokumen extends Model
{
    protected $fillable = [
        'jalur_pendaftaran_id',
        'nama',
        'slug',
        'keterangan',
        'format',
        'max_size',
        'is_wajib',
        'status',
        'kategori',
        'urutan',
    ];

    protected $casts = [
        'is_wajib' => 'boolean',
        'status' => 'boolean',
    ];

    public function jalurPendaftaran(): BelongsTo
    {
        return $this->belongsTo(JalurPendaftaran::class);
    }

    public function dokumenPendaftarans(): HasMany
    {
        return $this->hasMany(DokumenPendaftaran::class);
    }
}