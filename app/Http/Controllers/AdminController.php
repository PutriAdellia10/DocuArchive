<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Disposisi;
use App\Models\Notifikasi;
use App\Models\Instansi;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    // app/Http/Controllers/AdminController.php
public function index()
{
    // Ambil data disposisi dari database, muat relasi surat saja
$disposisiData = DB::table('disposisi')
    ->whereNotNull('catatan')
    ->get()
    ->map(function ($item) {
        try {
            $createdAt = Carbon::parse($item->created_at);
            $updatedAt = Carbon::parse($item->updated_at);

            // Hitung selisih waktu
            $item->waktu_penyelesaian = $createdAt->diff($updatedAt)->format('%d hari, %h jam, %i menit');
        } catch (\Exception $e) {
            $item->waktu_penyelesaian = 'Tanggal tidak valid';
        }

        return $item;
    });


    // Ambil 5 surat masuk terbaru
    $recentSuratMasuk = Surat::where('status', 'Masuk')
        ->orderBy('created_at', 'desc')
        ->take(2)
        ->get();

    // Ambil 5 surat keluar terbaru
    $recentSuratKeluar = Surat::where('status', 'Keluar')
        ->orderBy('created_at', 'desc')
        ->take(2)
        ->get();

    // Ambil notifikasi terbaru
    $notifikasi = Notifikasi::orderBy('dibuat_pada', 'desc')
        ->take(5)
        ->get();

    // Query untuk menghitung total surat
    $totalSuratPerTahun = DB::table('surat')
        ->whereYear('tanggal_surat', date('Y')) // Menghitung surat per tahun ini
        ->count(); // Menghitung total surat secara langsung

    // Total Surat Masuk dengan disposisi 'Selesai'
    $suratMasuk = Surat::where('status', 'Masuk')
        ->whereIn('status_disposisi', ['Selesai'])
        ->get();

    // Ambil koleksi surat keluar
    $suratKeluar = Surat::where('status', 'Keluar')
        ->whereIn('status_disposisi', ['Selesai'])
        ->whereNotIn('pengirim_id', function ($query) {
            $query->select('id')
                ->from('pengguna')
                ->whereIn('peran', ['Sekretariat', 'Admin']);
        })
        ->get();

    // Gabungkan koleksi surat masuk dan surat keluar
    $suratGabungan = $suratMasuk->merge($suratKeluar);
    $totalSuratKeluarSelesai = $suratKeluar->count();

    // Total Disposisi Aktif (status 'Masuk' atau 'Keluar' dan disposisi 'Belum Diproses' atau 'Diproses')
    $totalDisposisiAktif = Surat::whereIn('status', ['Masuk', 'Keluar'])
        ->whereIn('status_disposisi', ['Belum Diproses', 'Diproses'])
        ->count();

    // Data yang dikirim ke view
    $data = [
        'title' => 'Dashboard Admin',
        'pengguna' => User::all(),
        'totalInstansi' => Instansi::count(),
        'instansiList' => Instansi::all(),
        'recentSuratMasuk' => $recentSuratMasuk,
        'recentSuratKeluar' => $recentSuratKeluar,
        'notifikasi' => $notifikasi,
        'total_surat_gabungan' => $suratGabungan->count(),
        'totalSuratKeluarSelesai' => $totalSuratKeluarSelesai,
        'totalDisposisiAktif' => $totalDisposisiAktif,
        'totalSuratPerTahun' => $totalSuratPerTahun,
        'disposisiData' => $disposisiData, // Tambahkan data disposisi ke dalam data view
    ];

    // Kembali ke view dengan data yang diambil
    return view('layout.dashboard_admin', $data);
}

}
