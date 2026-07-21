<?php

namespace App\Providers;

use App\Models\MediaSosial;
use App\Models\ProfilSekolah;
use Blade;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Carbon::setLocale('id');
        setlocale(LC_TIME, 'id_ID.UTF-8');

        try {
            $profil = ProfilSekolah::first();
            if ($profil) {
                Config::set('mail.from.name', $profil->nama_sekolah ?? config('mail.from.name'));
            }
        } catch (\Exception $e) {
            // Table may not exist during tests or migrations
        }

        Blade::directive('date', function (string $expression) {
            return "<?php echo \\Carbon\\Carbon::parse($expression)->translatedFormat('l, j F Y'); ?>";
        });

        Blade::directive('datetime', function (string $expression) {
            return "<?php echo \\Carbon\\Carbon::parse($expression)->translatedFormat('l, j F Y H:i'); ?>";
        });

        View::composer(['components.layouts.public', 'layouts.app', 'layouts.peserta', 'layouts.guest', 'components.admin.sidebar', 'components.peserta.sidebar'], function ($view) {
            $view->with('profil', ProfilSekolah::first());
            $view->with('mediaSosial', MediaSosial::where('status', true)->orderBy('urutan')->get());
        });
    }
}
