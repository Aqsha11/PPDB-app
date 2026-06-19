<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{

    use HasFactory, Notifiable, HasRoles;



    protected $fillable = [

        'name',
        'email',
        'password',
        'status',
        'is_active',

    ];



    protected $hidden = [

        'password',
        'remember_token',

    ];



    protected $casts = [

        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',

    ];



    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }



    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }
}
