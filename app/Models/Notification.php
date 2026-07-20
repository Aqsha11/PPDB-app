<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

class Notification extends Model
{
    protected $fillable = ['type', 'notifiable_type', 'notifiable_id', 'data', 'read_at'];

    protected $casts = [
        'data' => 'array',
        'read_at' => 'datetime',
    ];

    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }

    public static function createNotif(string $title, string $url = '#', string $icon = 'info', ?Model $notifiable = null): self
    {
        $notifiable = $notifiable ?? User::find(1);

        return static::create([
            'id' => Str::uuid(),
            'type' => 'admin',
            'notifiable_type' => get_class($notifiable),
            'notifiable_id' => $notifiable->id,
            'data' => ['title' => $title, 'url' => $url, 'icon' => $icon],
        ]);
    }

    public static function notifyAdmins(string $title, string $url = '#', string $icon = 'info'): self
    {
        return static::createNotif($title, $url, $icon, User::find(1));
    }

    public static function notifyPeserta(Peserta $peserta, string $title, string $url = '#', string $icon = 'info'): self
    {
        return static::createNotif($title, $url, $icon, $peserta->user);
    }

    public function markAsRead(): bool
    {
        if (is_null($this->read_at)) {
            return $this->update(['read_at' => $this->freshTimestamp()]);
        }
        return false;
    }

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }
}
