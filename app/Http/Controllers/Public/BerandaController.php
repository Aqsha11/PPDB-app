<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\HeroBanner;
use App\Models\ProfilSekolah;
use App\Models\SambutanKepalaSekolah;
use App\Models\StatistikSekolah;
use App\Models\KeunggulanSekolah;
use App\Models\TahapanPpdb;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\Testimoni;
use App\Models\Partner;
use App\Models\Video;

class BerandaController extends Controller
{
    public function index()
    {
        $hero = HeroBanner::latest()->get();
        $profil = ProfilSekolah::first();
        $sambutan = SambutanKepalaSekolah::first();
        $statistik = StatistikSekolah::all();
        $keunggulan = KeunggulanSekolah::all();
        $tahapan = TahapanPpdb::orderBy('urutan')->get();
        $berita = Berita::latest()->take(3)->get();
        $galeri = Galeri::latest()->take(6)->get();
        $testimoni = Testimoni::all();
        $partner = Partner::all();
        $video = Video::all();

        return view('public.beranda', compact(
            'hero', 'profil', 'sambutan', 'statistik', 'keunggulan',
            'tahapan', 'berita', 'galeri', 'testimoni', 'partner', 'video'
        ));
    }
}
