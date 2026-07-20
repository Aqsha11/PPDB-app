<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Pendaftaran extends Model
{
    use HasFactory;

    const DRAFT = 'draft';
    const SUBMITTED = 'submitted';
    const VERIFIKASI = 'verifikasi';
    const DITERIMA = 'diterima';
    const CADANGAN = 'cadangan';
    const DITOLAK = 'ditolak';

    protected $fillable = [
        'user_id',
        'peserta_id',
        'tahun_ajaran_id',
        'periode_ppdb_id',
        'jalur_pendaftaran_id',
        'nomor_pendaftaran',
        'status_pendaftaran',
        'tanggal_submit',
    ];

    protected $casts = [
        'tanggal_submit' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function peserta(): BelongsTo
    {
        return $this->belongsTo(Peserta::class);
    }

    public function tahunAjaran(): BelongsTo
    {
        return $this->belongsTo(TahunAjaran::class);
    }

    public function periodePpdb(): BelongsTo
    {
        return $this->belongsTo(PeriodePpdb::class);
    }

    public function jalurPendaftaran(): BelongsTo
    {
        return $this->belongsTo(JalurPendaftaran::class);
    }

    public function dokumenPendaftarans(): HasMany
    {
        return $this->hasMany(DokumenPendaftaran::class);
    }

    public function verifikasi(): HasOne
    {
        return $this->hasOne(VerifikasiPendaftaran::class);
    }

    public function hasilSeleksi(): HasOne
    {
        return $this->hasOne(HasilSeleksi::class);
    }

    public function daftarUlang(): HasOne
    {
        return $this->hasOne(DaftarUlang::class);
    }
}