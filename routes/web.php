<?php
use App\Http\Controllers\InstansiController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SekretariatController;
use App\Http\Controllers\PimpinanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\RekapitulasiSuratController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SifatSuratController;

use App\Http\Controllers\ProfilPerusahaanController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/register', function () {
    return view('auth.register');
});
Route::get('/index', function () {
    return view('index');
});

Route::get('/dashboard_admin', function () {
    return view('layout.dashboard_admin');
});

Route::get('/disposisi', function () {
    return view('layout.disposisi');
});


//login
// Routes untuk pengguna yang belum login (guest)
Route::middleware(['guest'])->group(function() {
    // Route untuk menampilkan formulir pendaftaran
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

    // Route untuk menangani pengiriman formulir pendaftaran
    Route::post('/register', [AuthController::class, 'register']);

    // Route untuk menampilkan formulir login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

    // Route untuk menangani login
    Route::post('/login', [AuthController::class, 'login']);
});

// Route untuk menangani logout (hanya untuk pengguna yang sudah login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
   // Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
});


// Route untuk menyimpan user
Route::post('/user', [UserController::class, 'store'])->name('user.store');
Route::get('/userprofil', [UserController::class, 'show'])->name('user.profil');

// Route untuk edit dan update user
Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update'); // Hanya gunakan yang ini untuk update
Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');

// Routes untuk dashboard berdasarkan role
Route::get('/dashboard_admin', [AdminController::class, 'index'])->name('dashboard_admin');
Route::get('/dashboard_sekretariat', [SekretariatController::class, 'index'])->name('dashboard_sekretariat');
Route::get('/dashboard_karyawan', [KaryawanController::class, 'index'])->name('dashboard_karyawan');
Route::get('/dashboard_pimpinan', [PimpinanController::class, 'index'])->name('dashboard_pimpinan');


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

Route::resource('disposisi', DisposisiController::class);
Route::get('/disposisi', [DisposisiController::class, 'disposisi'])->name('disposisi');
Route::get('/disposisi/create', [DisposisiController::class, 'create'])->name('disposisi.create');
Route::post('/disposisi', [DisposisiController::class, 'store'])->name('disposisi.store');
Route::post('/disposisi/kirim', [DisposisiController::class, 'kirimNotifikasi'])->name('disposisi.kirim');
Route::get('/surat/{id}/disposisi', [SuratController::class, 'disposisi'])->name('surat.disposisi');


Route::get('/profilperusahaan', [ProfilPerusahaanController::class, 'index'])->name('profilperusahaan.index');
Route::put('/profilperusahaan', [ProfilPerusahaanController::class, 'update'])->name('profilperusahaan.update');


Route::get('/rekapitulasi', [RekapitulasiSuratController::class, 'index'])->name('rekapitulasi.index');


// Rute untuk menampilkan laporan masuk
Route::get('/laporan-masuk', [LaporanController::class, 'laporanMasuk'])->name('laporan.masuk');
// Rute untuk menampilkan laporan keluar
Route::get('/laporan-keluar', [LaporanController::class, 'laporanKeluar'])->name('laporan.keluar');


Route::get('instansi', [InstansiController::class, 'index'])->name('instansi.index');
Route::post('instansi', [InstansiController::class, 'store'])->name('instansi.store');
Route::get('instansi/{id}', [InstansiController::class, 'show'])->name('instansi.show');
Route::put('/instansi/{id}', [InstansiController::class, 'update'])->name('instansi.update');
Route::delete('instansi/{id}', [InstansiController::class, 'destroy'])->name('instansi.destroy');
Route::get('/cariInstansi', [InstansiController::class, 'cariInstansi'])->name('instansi.cari');


// Menampilkan daftar sifat surat
Route::get('sifat_surat', [SifatSuratController::class, 'index'])->name('sifat_surat.index');
Route::get('sifat_surat/create', [SifatSuratController::class, 'create'])->name('sifat_surat.create');
Route::post('sifat_surat', [SifatSuratController::class, 'store'])->name('sifat_surat.store');
Route::get('sifat_surat/{id}/edit', [SifatSuratController::class, 'edit'])->name('sifat_surat.edit');
Route::put('sifat_surat/{id}', [SifatSuratController::class, 'update'])->name('sifat_surat.update');
Route::delete('sifat_surat/{id}', [SifatSuratController::class, 'destroy'])->name('sifat_surat.destroy');
Route::get('sifat_surat/{id}', [SifatSuratController::class, 'show'])->name('sifat_surat.show');

use App\Http\Controllers\NotifikasiController;

Route::middleware('auth')->group(function () {
    // Route untuk menampilkan notifikasi pengguna
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');

    // Route untuk menandai notifikasi sebagai sudah dibaca
    Route::get('/notifikasi/{id}/read', [NotifikasiController::class, 'markAsRead'])->name('notifikasi.markAsRead');

    // Route untuk membuat notifikasi baru
    Route::post('/notifikasi/create', [NotifikasiController::class, 'create'])->name('notifikasi.create');
});
