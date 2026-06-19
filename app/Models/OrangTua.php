<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrangTua extends Model
{
    use HasFactory;
    protected $fillable = [
        'siswa_id',
        'nama_ayah',
        'nik_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'nik_ibu',
        'pekerjaan_ibu',
        'penghasilan',
        'no_hp',
    ];

    protected $casts = [
        'penghasilan' => 'decimal:2',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }
}