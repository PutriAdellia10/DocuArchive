<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\RekapitulasiSuratController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/index', function () {
    return view('index');
});

// Routes for Surat Masuk
Route::get('/surat-masuk', [SuratController::class, 'indexMasuk'])->name('surat.index');
Route::get('/surat-masuk/create', [SuratController::class, 'create'])->name('surat.create');
Route::post('/surat-masuk', [SuratController::class, 'store'])->name('surat.store');
Route::get('/surat-masuk/{id}/edit', [SuratController::class, 'edit'])->name('surat.edit');
Route::put('/surat-masuk/{id}', [SuratController::class, 'update'])->name('surat.update');
Route::delete('/surat-masuk/{id}', [SuratController::class, 'destroy'])->name('surat.destroy');
Route::get('/surat-masuk/{id}', [SuratController::class, 'show'])->name('surat.show');

// Routes for Surat Keluar
Route::get('/surat-keluar', [SuratController::class, 'indexKeluar'])->name('surat.keluar.index');
Route::get('/surat-keluar/create', [SuratController::class, 'keluarcreate'])->name('surat.keluar.create');
Route::post('/surat-keluar', [SuratController::class, 'keluarstore'])->name('surat.keluar.store');
Route::get('/surat-keluar/{id}/edit', [SuratController::class, 'keluaredit'])->name('surat.keluar.edit');
Route::put('/surat-keluar/{id}', [SuratController::class, 'keluarupdate'])->name('surat.keluar.update');
Route::delete('/surat-keluar/{id}', [SuratController::class, 'keluardestroy'])->name('surat.keluar.destroy');
Route::get('/surat-keluar/{id}', [SuratController::class, 'keluarshow'])->name('surat.keluar.show');


//Route::get('/surat/{id}/disposisi', [SuratController::class, 'showDisposisi'])->name('surat.disposisi');

Route::resource('jenis_surat', JenisSuratController::class);
Route::resource('instansi', InstansiController::class);


Route::get('/rekapitulasi', [RekapitulasiSuratController::class, 'index'])->name('rekapitulasi.index');

use App\Http\Controllers\LaporanController;

// Rute untuk menampilkan laporan masuk
Route::get('/laporan-masuk', [LaporanController::class, 'laporanMasuk'])->name('laporan.masuk');

// Rute untuk menampilkan laporan keluar
Route::get('/laporan-keluar', [LaporanController::class, 'laporanKeluar'])->name('laporan.keluar');





