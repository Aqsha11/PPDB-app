<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\CustomVerifyEmail;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable implements MustVerifyEmail
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



    public function peserta()
    {
        return $this->hasOne(Peserta::class);
    }



    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }
}
