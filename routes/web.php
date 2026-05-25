<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PengumumanMasjidController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\JadwalPetugasController;
use App\Http\Controllers\UstadzController;
use App\Http\Controllers\AgendaKajianController;
use App\Http\Controllers\JadwalJumatController;
use App\Http\Controllers\JadwalMarbotController;

// Halaman welcome
Route::get('/', fn() => view('welcome'));

// ======================= PROFILE =======================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Default Breeze dashboard
Route::middleware(['auth','verified'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
});

// ======================= ADMIN =======================
Route::middleware(['auth','verified','role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Export PDF laporan keuangan
        Route::get('/keuangan/export-pdf', [KeuanganController::class, 'exportPdf'])
            ->name('keuangan.export-pdf');

        // Export PDF Manage Aset
        Route::get('/asets/export-pdf', [AsetController::class, 'exportPdf'])
            ->name('asets.export-pdf');

        // Export PDF Jadwal jumat dan Marbot
        Route::get('jadwal-jumat/export', [JadwalJumatController::class,'export'])->name('jadwal-jumat.export');
        Route::get('jadwal-marbot/export', [JadwalMarbotController::class,'export'])->name('jadwal-marbot.export');


        // Dashboard admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Manajemen user
        Route::resource('users', UserController::class);

        // Artikel
        Route::resource('articles', ArticleController::class);

        // Pengumuman Masjid
        Route::resource('pengumuman-masjid', PengumumanMasjidController::class);

        // Keuangan Masjid
        Route::resource('keuangan', KeuanganController::class);

        // Aset Masjid
        Route::resource('asets', AsetController::class);

        // Ustad
        Route::resource('ustadz', UstadzController::class)->except(['show']);

        // Agenda Kajian
        Route::resource('agenda-kajian', AgendaKajianController::class);

        // Jadwal Petugas
        Route::resource('jadwal-jumat', JadwalJumatController::class);

        // Jadwal Marbot
        Route::resource('jadwal-marbot', JadwalMarbotController::class);

        // Jadwal Petugas (Isinya hanya shortcut ke Jadwal Jumat dan Marbot)
        Route::resource('jadwal-petugas', JadwalPetugasController::class);
    });

// ======================= USER =======================
Route::middleware(['auth','verified','role:user'])->group(function () {
    Route::get('/users-dashboard', [UserDashboardController::class, 'index'])->name('users.dashboard');
    Route::get('/users-profile', [ProfileController::class, 'show'])->name('users.profile');
    Route::get('/users-articles', [UserDashboardController::class, 'articles'])->name('users.articles');
    Route::get('/users-articles/{slug}', [UserDashboardController::class, 'showArticle'])->name('users.articles.show');
    Route::get('/users-keuangan', [KeuanganController::class, 'laporan'])->name('users.keuangan.laporan');
});


// Agenda Kajian untuk user
Route::get('/users-agenda-kajian', [UserDashboardController::class, 'kajianIndex'])
    ->name('users.agenda-kajian.index');
Route::get('/users-agenda-kajian/{slug}', [UserDashboardController::class, 'kajianShow'])
    ->name('users.agenda-kajian.show');


// ======================= PUBLIC =======================
Route::get('/pengumuman', [PengumumanMasjidController::class, 'userIndex'])->name('pengumuman.index');
Route::get('/pengumuman/{slug}', [PengumumanMasjidController::class, 'userShow'])->name('pengumuman.show');

require __DIR__.'/auth.php';
