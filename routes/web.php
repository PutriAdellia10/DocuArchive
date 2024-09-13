<?php
use App\Http\Controllers\InstansiController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/index', function () {
    return view('index');
});
Route::get('/dashboard', function () {
    return view('layout.dashboard');
});
Route::get('/suratmasuk', function () {
    return view('layout.suratmasuk');
});
Route::get('/tambahsuratmasuk', function () {
    return view('layout.tambahsuratmasuk');
});
// Route::get('/instansi', function () {
//     return view('layout.instansi');
// })->name('instansi');
// Route::get('/tambahinstansi', function () {
//     return view('layout.tambahinstansi');
// })->name('tambahinstansi');
// use App\Http\Controllers\InstansiController;

// Route::get('/instansi', [InstansiController::class, 'index'])->name('instansi');
// Route::get('/instansi/tambah', [InstansiController::class, 'create'])->name('instansi.create');
// Route::post('/instansi', [InstansiController::class, 'store'])->name('instansi.store');


// Route::resource('instansi', InstansiController::class);
// Route::get('instansi/{id}', [InstansiController::class, 'show']);
// Route::get('/instansi', [InstansiController::class, 'index'])->name('instansi.index');
// Route::post('/instansi', [InstansiController::class, 'store']);
// Route::delete('/instansi/{id}', [InstansiController::class, 'destroy']);
// Route::put('/instansi/{id}', [InstansiController::class, 'update'])->name('instansi.update');



Route::get('instansi', [InstansiController::class, 'index'])->name('instansi.index');
Route::post('instansi', [InstansiController::class, 'store'])->name('instansi.store');
Route::get('instansi/{id}', [InstansiController::class, 'show'])->name('instansi.show');
Route::delete('instansi/{id}', [InstansiController::class, 'destroy'])->name('instansi.destroy');

// Route::get('/templatesurat', function () {
//     return view('layout.templatesurat');
// });
// use App\Http\Controllers\TemplateSuratController;

// Route::resource('template_surat', TemplateSuratController::class);
use App\Http\Controllers\TemplateSuratController;

Route::get('template_surat', [TemplateSuratController::class, 'index'])->name('template_surat.index');
Route::post('/template_surat', [TemplateSuratController::class, 'store'])->name('template_surat.store');
Route::put('template_surat/{id}', [TemplateSuratController::class, 'update']);
Route::delete('template_surat/{id}', [TemplateSuratController::class, 'destroy']);

Route::get('/generete', function () {
    return view('layout.generete');
});
