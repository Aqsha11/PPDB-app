<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DaftarUlang extends Model
{
    protected $fillable = [
        'pendaftaran_id',
        'status',
        'tanggal_daftar_ulang',
        'catatan',
        'bukti_kelulusan',
        'fotokopi_kk',
        'akta_kelahiran',
        'ktp_orang_tua',
        'skl_ijazah',
    ];

    protected $casts = [
        'tanggal_daftar_ulang' => 'datetime',
    ];

    public function pendaftaran(): BelongsTo
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
