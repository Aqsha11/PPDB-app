<?php

use App\Http\Controllers\Siswa\DashboardController;
use App\Http\Controllers\Siswa\BiodataController;
use App\Http\Controllers\Siswa\DokumenController;
use App\Http\Controllers\Siswa\OrangTuaController;
use App\Http\Controllers\Siswa\JalurController;
use App\Http\Controllers\Siswa\SekolahAsalController;
use App\Http\Controllers\Siswa\SubmitPendaftaranController;
use App\Http\Controllers\Siswa\DaftarUlangController;
use App\Http\Controllers\Siswa\PengumumanController;
use Illuminate\Support\Facades\Route;

Route::prefix('siswa')->name('siswa.')->middleware(['auth', 'verified', 'role:siswa'])->group(function () {
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
});
