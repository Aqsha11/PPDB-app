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
use App\Http\Controllers\Admin\BrandingController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\NotificationController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'role:Super Admin|Admin|Operator|Verifikator'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data
    Route::resource('tahun-ajaran', TahunAjaranController::class);
    Route::put('/tahun-ajaran/{tahun_ajaran}/toggle-status', [TahunAjaranController::class, 'toggleStatus'])->name('tahun-ajaran.toggle-status');
    Route::resource('periode', PeriodePpdbController::class);
    Route::put('/periode/{periode}/toggle-status', [PeriodePpdbController::class, 'toggleStatus'])->name('periode.toggle-status');
    Route::resource('jalur', JalurPendaftaranController::class);
    Route::put('/jalur/{jalur}/toggle-status', [JalurPendaftaranController::class, 'toggleStatus'])->name('jalur.toggle-status');
    Route::resource('dokumen-persyaratan', PersyaratanDokumenController::class);
    Route::put('/dokumen-persyaratan/{dokumen_persyaratan}/toggle-status', [PersyaratanDokumenController::class, 'toggleStatus'])->name('dokumen-persyaratan.toggle-status');

    // Pendaftaran & Seleksi
    Route::resource('pendaftaran', PendaftaranController::class)->only('index', 'show', 'destroy');
    Route::resource('verifikasi', VerifikasiController::class)->only('index', 'update');
    Route::resource('kelulusan', KelulusanController::class)->only('index', 'store');
    Route::resource('daftar-ulang', DaftarUlangController::class)->only('index', 'update');

    // Manajemen Biodata & Dokumen Peserta
    Route::resource('biodata', BiodataController::class)->parameters(['biodata' => 'peserta'])->only('index', 'show', 'edit', 'update', 'destroy');
    Route::resource('dokumen-peserta', DokumenController::class)->only('index', 'show', 'destroy');

    // CMS Content
    Route::resource('berita', BeritaController::class);
    Route::put('/berita/{berita}/toggle-status', [BeritaController::class, 'toggleStatus'])->name('berita.toggle-status');
    Route::resource('hero', HeroBannerController::class);
    Route::put('/hero/{hero}/toggle-status', [HeroBannerController::class, 'toggleStatus'])->name('hero.toggle-status');
    Route::resource('faq', FaqController::class);
    Route::put('/faq/{faq}/toggle-status', [FaqController::class, 'toggleStatus'])->name('faq.toggle-status');
    Route::resource('galeri', GaleriController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('keunggulan', KeunggulanController::class);
    Route::resource('media-sosial', MediaSosialController::class)->only('index', 'update');
    Route::put('/media-sosial/{mediaSosial}/toggle-status', [MediaSosialController::class, 'toggleStatus'])->name('media-sosial.toggle-status');
    Route::resource('pengumuman', PengumumanController::class);
    Route::put('/pengumuman/{pengumuman}/toggle-status', [PengumumanController::class, 'toggleStatus'])->name('pengumuman.toggle-status');
    Route::resource('statistik', StatistikController::class);
    Route::put('/statistik/{statistik}/toggle-status', [StatistikController::class, 'toggleStatus'])->name('statistik.toggle-status');
    Route::resource('tahapan', TahapanController::class);
    Route::resource('testimoni', TestimoniController::class);
    Route::put('/testimoni/{testimoni}/toggle-status', [TestimoniController::class, 'toggleStatus'])->name('testimoni.toggle-status');
    Route::resource('video', VideoController::class);
    Route::put('/video/{video}/toggle-status', [VideoController::class, 'toggleStatus'])->name('video.toggle-status');

    // Single-row settings
    Route::get('/profil-sekolah', [ProfilSekolahController::class, 'index'])->name('profil.index');
    Route::put('/profil-sekolah', [ProfilSekolahController::class, 'update'])->name('profil.update');
    Route::get('/sambutan', [SambutanController::class, 'index'])->name('sambutan.index');
    Route::put('/sambutan', [SambutanController::class, 'update'])->name('sambutan.update');
    // Pesan Kontak
    Route::get('/pesan-kontak', [KontakController::class, 'index'])->name('kontak.index');
    Route::get('/pesan-kontak/{id}', [KontakController::class, 'show'])->name('kontak.show');
    Route::delete('/pesan-kontak/{id}', [KontakController::class, 'destroy'])->name('kontak.destroy');
    Route::get('/branding', [BrandingController::class, 'index'])->name('branding.index');
    Route::put('/branding', [BrandingController::class, 'update'])->name('branding.update');
    Route::get('/seo', [SeoController::class, 'index'])->name('seo.index');
    Route::put('/seo', [SeoController::class, 'update'])->name('seo.update');

    // User & Role Management
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);

    // Theme
    Route::post('/theme', [ThemeController::class, 'update'])->name('theme.update');

    // Notifications
    Route::prefix('notifikasi')->name('notifikasi.')->group(function () {
        Route::get('/', [NotificationController::class, 'page'])->name('index');
        Route::get('/api', [NotificationController::class, 'index'])->name('api');
        Route::post('/{notification}/read', [NotificationController::class, 'markAsRead'])->name('read');
        Route::post('/read-all', [NotificationController::class, 'markAllAsRead'])->name('read-all');
        Route::get('/unread-count', [NotificationController::class, 'unreadCount'])->name('unread-count');
    });
});
