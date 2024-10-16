<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Instansi;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
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

        // query untuk menghitung total surat
        $totalSuratPerTahun = DB::table('surat')
        ->whereYear('tanggal_surat', date('Y')) // Menghitung surat per tahun ini
        ->count(); // Menghitung total surat secara langsung

        // Contoh pengambilan data untuk dashboard admin, bisa diubah sesuai kebutuhan
        $data = [
            'title' => 'Dashboard Admin',
            'pengguna' => \App\Models\User::all(),
            'totalSuratMasuk' => Surat::where('status', 'Masuk')->count(),
            'totalSuratKeluar' => Surat::where('status', 'Keluar')->count(),
            'totalInstansi' => Instansi::count(),
            'instansiList' => Instansi::all(),
            'recentSuratMasuk' => $recentSuratMasuk,
            'recentSuratKeluar' => $recentSuratKeluar,
            'notifikasi' => $notifikasi, // Tambahkan notifikasi di
            'totalsuratpertahun'=> $totalSuratPerTahun,

        ];

        // Return ke view dashboard_admin dengan data yang diambil
        return view('layout.dashboard_admin', $data);
    }
}
