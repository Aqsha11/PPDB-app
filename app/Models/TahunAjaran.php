<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TahunAjaran extends Model
{
    protected $fillable = [
        'nama',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];

    public function periodePpdbs(): HasMany
    {
        return $this->hasMany(PeriodePpdb::class);
    }

    public function pendaftarans(): HasMany
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function scopeAktif($query)
    {
        return $query->where('status_aktif', true);
    }

    public function getTahunAwalAttribute()
    {
        return explode('/', $this->nama)[0] ?? null;
    }

    public function getTahunAkhirAttribute()
    {
        return explode('/', $this->nama)[1] ?? null;
    }

    public function getIsAktifAttribute()
    {
        return $this->status_aktif;
    }

    public function periode()
    {
        return $this->periodePpdbs();
    }
}
