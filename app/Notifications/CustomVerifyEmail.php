<?php

namespace App\Notifications;

use App\Models\ProfilSekolah;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class CustomVerifyEmail extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $profil = ProfilSekolah::first();
        $namaSekolah = $profil->nama_sekolah ?? config('app.name', 'PPDB');
        $emailSekolah = config('mail.from.address');
        $namaUser = $notifiable->name ?? $notifiable->email;

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        return (new MailMessage)
            ->subject('Verifikasi Alamat Email - ' . $namaSekolah)
            ->from($emailSekolah, $namaSekolah)
            ->line('Halo, ' . $namaUser . '!')
            ->line('Selamat datang di ' . $namaSekolah . '. Silakan klik tombol di bawah untuk memverifikasi alamat email Anda.')
            ->action('Verifikasi Email', $verificationUrl)
            ->line('Jika Anda tidak membuat akun ini, abaikan email ini.');
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}
