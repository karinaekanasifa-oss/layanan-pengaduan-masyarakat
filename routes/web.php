<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\Admin\ReportAssignmentController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Petugas\PetugasController;
use App\Http\Controllers\Masyarakat\MasyarakatController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

// ================= RUTE AUTENTIKASI (LOGIN & REGISTER) =================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Halaman utama (Publik / Bisa dilihat tanpa login)
Route::get('/', [MasyarakatController::class, 'index'])->name('masyarakat.dashboard');

// AREA MASYARAKAT (Dashboard publik, tapi Pengaduan & Riwayat wajib login & role Masyarakat)
Route::prefix('masyarakat')->name('masyarakat.group.')->group(function () {
    Route::get('/dashboard', [MasyarakatController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'role:Masyarakat'])->prefix('masyarakat')->name('masyarakat.')->group(function () {
    Route::get('/pengaduan', [MasyarakatController::class, 'create'])->name('pengaduan');
    Route::post('/pengaduan/store', [MasyarakatController::class, 'store'])->name('store');
    Route::get('/riwayat', [MasyarakatController::class, 'riwayat'])->name('riwayat');
    Route::get('/riwayat/detail/{id}', [MasyarakatController::class, 'show'])->name('show'); // Tambahan rute detail
});

// AREA ADMIN (Wajib login & role Admin)
Route::middleware(['auth', 'role:Admin'])->prefix('admin')->group(function () {
    // 1. Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    // 2. Zona Wilayah
    Route::prefix('zona')->group(function () {
        Route::get('/', [ZoneController::class, 'index'])->name('zona.index');
        Route::get('/tambah', [ZoneController::class, 'create'])->name('zona.create');
        Route::post('/store', [ZoneController::class, 'store'])->name('zona.store');
        Route::get('/update/{id}', [ZoneController::class, 'edit'])->name('zona.edit');
        Route::put('/update/{id}', [ZoneController::class, 'update'])->name('zona.update');
        Route::delete('/delete/{id}', [ZoneController::class, 'destroy'])->name('zona.destroy');
    });

    // 3. Laporan Masuk dari Masyarakat
    Route::prefix('laporan')->group(function () {
        Route::get('/', [ReportAssignmentController::class, 'indexLaporan'])->name('laporan.index');
        Route::get('/rekapitulasi', [ReportAssignmentController::class, 'rekapitulasi'])->name('laporan.rekapitulasi');
        Route::get('/detail/{id}', [ReportAssignmentController::class, 'showLaporan'])->name('laporan.show');
        Route::post('/store', [ReportAssignmentController::class, 'storeLaporan'])->name('laporan.store');
    });

    // 4. Penugasan Lapangan ke Petugas
    Route::prefix('penugasan')->group(function () {
        Route::get('/', [ReportAssignmentController::class, 'indexPenugasan'])->name('penugasan.index');
        Route::get('/tambah', [ReportAssignmentController::class, 'createPenugasan'])->name('penugasan.create');
        Route::post('/store', [ReportAssignmentController::class, 'storePenugasan'])->name('penugasan.store');
        Route::get('/update/{id}', [ReportAssignmentController::class, 'editPenugasan'])->name('penugasan.edit');
        Route::put('/update/{id}', [ReportAssignmentController::class, 'updatePenugasan'])->name('penugasan.update');
        Route::delete('/delete/{id}', [ReportAssignmentController::class, 'destroyPenugasan'])->name('penugasan.destroy');
    });

    // 5. Pengguna (Admin, Petugas, Masyarakat)
    Route::prefix('pengguna')->group(function () {
        Route::get('/', [PenggunaController::class, 'index'])->name('pengguna.index');
        Route::get('/tambah', [PenggunaController::class, 'create'])->name('pengguna.create');
        Route::post('/store', [PenggunaController::class, 'store'])->name('pengguna.store');
        Route::get('/detail/{id}', [PenggunaController::class, 'show'])->name('pengguna.show');
        Route::get('/update/{id}', [PenggunaController::class, 'edit'])->name('pengguna.edit');
        Route::put('/update/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
        Route::delete('/delete/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
    });

});

// AREA PETUGAS (Wajib login & role Petugas)
Route::middleware(['auth', 'role:Petugas'])->prefix('petugas')->group(function () {
    Route::get('/dashboard', [PetugasController::class, 'index'])->name('petugas.dashboard');
    Route::prefix('penugasan')->group(function () {
        Route::get('/', [PetugasController::class, 'penugasan'])->name('petugas.penugasan');
        Route::get('/detail/{id}', [PetugasController::class, 'detailPenugasan'])->name('petugas.penugasan.detail');
        Route::put('/update/{id}', [PetugasController::class, 'updateProgres'])->name('petugas.penugasan.update');
    });

});
