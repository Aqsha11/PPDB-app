<?php

use App\Http\Controllers\Peserta\DashboardController;
use App\Http\Controllers\Peserta\BiodataController;
use App\Http\Controllers\Peserta\DokumenController;
use App\Http\Controllers\Peserta\OrangTuaController;
use App\Http\Controllers\Peserta\JalurController;
use App\Http\Controllers\Peserta\SekolahAsalController;
use App\Http\Controllers\Peserta\SubmitPendaftaranController;
use App\Http\Controllers\Peserta\DaftarUlangController;
use App\Http\Controllers\Peserta\PengumumanController;
use App\Http\Controllers\Peserta\PendaftaranSayaController;
use App\Http\Controllers\Peserta\ProfilController;
use App\Http\Controllers\Peserta\ChatController;
use App\Http\Controllers\Admin\NotificationController;
use Illuminate\Support\Facades\Route;

Route::prefix('peserta')->name('peserta.')->middleware(['auth', 'verified', 'role:Peserta', 'registration'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Data diri
    Route::get('/biodata', [BiodataController::class, 'edit'])->name('biodata.edit');
    Route::put('/biodata', [BiodataController::class, 'update'])->name('biodata.update');

    Route::get('/orang-tua', [OrangTuaController::class, 'edit'])->name('orang-tua.edit');
    Route::put('/orang-tua', [OrangTuaController::class, 'update'])->name('orang-tua.update');

    Route::get('/sekolah-asal', [SekolahAsalController::class, 'edit'])->name('sekolah-asal.edit');
    Route::put('/sekolah-asal', [SekolahAsalController::class, 'update'])->name('sekolah-asal.update');

    // Jalur pendaftaran
    Route::get('/jalur', [JalurController::class, 'index'])->name('jalur.index');
    Route::post('/jalur', [JalurController::class, 'store'])->name('jalur.store');

    // Submit pendaftaran
    Route::post('/pendaftaran/submit', [SubmitPendaftaranController::class, 'store'])->name('pendaftaran.submit');

    // Dokumen
    Route::get('/dokumen', [DokumenController::class, 'index'])->name('dokumen.index');
    Route::post('/dokumen', [DokumenController::class, 'store'])->name('dokumen.store');
    Route::delete('/dokumen/{dokumen}', [DokumenController::class, 'destroy'])->name('dokumen.destroy');

    // Pengumuman
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');

    // Daftar ulang
    Route::get('/daftar-ulang', [DaftarUlangController::class, 'index'])->name('daftar-ulang.index');
    Route::post('/daftar-ulang', [DaftarUlangController::class, 'store'])->name('daftar-ulang.store');

    // Pendaftaran Saya
    Route::get('/pendaftaran', [PendaftaranSayaController::class, 'index'])->name('pendaftaran.index');
    Route::get('/pendaftaran/cetak', [PendaftaranSayaController::class, 'cetak'])->name('pendaftaran.cetak');

    // Profil
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [ProfilController::class, 'password'])->name('profil.password');

    // Chat
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
    Route::post('/chat/mark-read', [ChatController::class, 'markRead'])->name('chat.mark-read');
    Route::get('/chat/unread-count', [ChatController::class, 'unreadCount'])->name('chat.unread-count');
    Route::post('/chat/escalate', [ChatController::class, 'escalate'])->name('chat.escalate');

    // Notifikasi
    Route::get('/notifikasi/api', [NotificationController::class, 'index'])->name('notifikasi.api');
    Route::post('/notifikasi/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifikasi.read');
    Route::post('/notifikasi/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifikasi.read-all');
    Route::get('/notifikasi/unread-count', [NotificationController::class, 'unreadCount'])->name('notifikasi.unread-count');
});
