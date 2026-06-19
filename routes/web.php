<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\BerandaController;
use App\Http\Controllers\Public\BeritaController;
use App\Http\Controllers\Public\GaleriController;
use App\Http\Controllers\Public\KontakController;
use App\Http\Controllers\Public\PengumumanController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::name('public.')->group(function () {
    Route::get('/', [BerandaController::class, 'index'])->name('beranda');
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman.index');
    Route::get('/pengumuman/{slug}', [PengumumanController::class, 'show'])->name('pengumuman.show');
    Route::get('/kontak', [KontakController::class, 'index'])->name('kontak.index');
    Route::post('/kontak', [KontakController::class, 'store'])->name('kontak.store');
});

// Auth routes (default Breeze)
require __DIR__.'/auth.php';

// Authenticated user routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin & Siswa panels
require __DIR__.'/admin.php';
require __DIR__.'/siswa.php';
