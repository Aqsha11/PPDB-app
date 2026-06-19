<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TahunAjaranController;
use App\Http\Controllers\Admin\PeriodePpdbController;
use App\Http\Controllers\Admin\JalurPendaftaranController;
use App\Http\Controllers\Admin\PersyaratanDokumenController;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\Admin\KelulusanController;
use App\Http\Controllers\Admin\DaftarUlangController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\HeroBannerController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\KeunggulanController;
use App\Http\Controllers\Admin\MediaSosialController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\ProfilSekolahController;
use App\Http\Controllers\Admin\SambutanController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\StatistikController;
use App\Http\Controllers\Admin\TahapanController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\BiodataController;
use App\Http\Controllers\Admin\DokumenController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data
    Route::resource('tahun-ajaran', TahunAjaranController::class)->except('show');
    Route::resource('periode', PeriodePpdbController::class)->except('show');
    Route::resource('jalur', JalurPendaftaranController::class)->only('index', 'create', 'store', 'destroy');

    // Pendaftaran & Seleksi
    Route::resource('pendaftaran', PendaftaranController::class)->only('index', 'show', 'destroy');
    Route::resource('verifikasi', VerifikasiController::class)->only('index', 'update');
    Route::resource('kelulusan', KelulusanController::class)->only('index', 'store');
    Route::resource('daftar-ulang', DaftarUlangController::class)->only('index', 'update');

    // Manajemen Biodata & Dokumen Siswa
    Route::resource('biodata', BiodataController::class);
    Route::resource('dokumen-persyaratan', PersyaratanDokumenController::class)->only('index', 'store', 'destroy');
    Route::resource('dokumen-siswa', DokumenController::class)->only('index', 'show', 'destroy');

    // CMS Content
    Route::resource('berita', BeritaController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('hero', HeroBannerController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('faq', FaqController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('galeri', GaleriController::class)->only('index', 'store', 'destroy');
    Route::resource('jadwal', JadwalController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('keunggulan', KeunggulanController::class)->only('index', 'store', 'destroy');
    Route::resource('media-sosial', MediaSosialController::class)->only('index', 'store', 'update', 'destroy');
    Route::resource('partner', PartnerController::class)->only('index', 'store', 'destroy');
    Route::resource('pengumuman', PengumumanController::class)->only('index', 'store', 'destroy');
    Route::resource('statistik', StatistikController::class)->only('index', 'store', 'destroy');
    Route::resource('tahapan', TahapanController::class)->only('index', 'store', 'destroy');
    Route::resource('testimoni', TestimoniController::class)->only('index', 'store', 'destroy');
    Route::resource('video', VideoController::class)->only('index', 'store', 'destroy');

    // Single-row settings
    Route::get('/profil-sekolah', [ProfilSekolahController::class, 'index'])->name('profil.index');
    Route::put('/profil-sekolah', [ProfilSekolahController::class, 'update'])->name('profil.update');
    Route::get('/sambutan', [SambutanController::class, 'index'])->name('sambutan.index');
    Route::put('/sambutan', [SambutanController::class, 'update'])->name('sambutan.update');
    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');
    Route::put('/kontak', [KontakController::class, 'update'])->name('kontak.update');
    Route::get('/footer', [FooterController::class, 'index'])->name('footer.index');
    Route::put('/footer', [FooterController::class, 'update'])->name('footer.update');
    Route::get('/seo', [SeoController::class, 'index'])->name('seo.index');
    Route::put('/seo', [SeoController::class, 'update'])->name('seo.update');

    // User & Role Management
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
});
