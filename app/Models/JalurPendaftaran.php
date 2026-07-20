<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JalurPendaftaran extends Model
{
    protected $fillable = [
        'nama',
        'slug',
        'kuota',
        'deskripsi',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function persyaratanDokumens(): HasMany
    {
        return $this->hasMany(PersyaratanDokumen::class);
    }

    public function pendaftarans(): HasMany
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function scopeAktif($query)
    {
        return $query->where('status', true);
    }

    public function getNamaJalurAttribute()
    {
        return $this->nama;
    }

    public function getIsAktifAttribute()
    {
        return $this->status;
    }

    public function persyaratanDokumen()
    {
        return $this->persyaratanDokumens();
    }
}