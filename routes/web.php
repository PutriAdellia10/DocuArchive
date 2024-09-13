<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DisposisiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SekretariatController;

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
/*Route::get('/dashboard', function () {
    return view('layout.dashboard');
});*/
Route::get('/dashboard_admin', function () {
    return view('layout.dashboard_admin');
});
Route::get('/suratmasuk', function () {
    return view('layout.suratmasuk');
});
Route::get('/tambahsuratmasuk', function () {
    return view('layout.tambahsuratmasuk');
});
Route::get('/disposisi', function () {
    return view('layout.disposisi');
});


//login
Route::middleware(['guest'])->group(function(){
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

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

