<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Notifikasi;
class KaryawanController extends Controller
{
    public function index()
    {
        // Ambil 5 surat masuk terbaru
        $recentSuratMasuk = Surat::where('status', 'Masuk')
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();

        // Ambil 5 surat keluar terbaru
        $recentSuratKeluar = Surat::where('status', 'Keluar')
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get();

        // Ambil notifikasi terbaru
        $notifikasi = Notifikasi::orderBy('dibuat_pada', 'desc')
            ->take(5)
            ->get();

        // Contoh pengambilan data untuk dashboard admin, bisa diubah sesuai kebutuhan
        $data = [
            'title' => 'Dashboard Admin',
            'pengguna' => \App\Models\User::all(),
            'totalSuratMasuk' => Surat::where('status', 'Masuk')->count(),
            'totalSuratKeluar' => Surat::where('status', 'Keluar')->count(),
            'recentSuratMasuk' => $recentSuratMasuk,
            'recentSuratKeluar' => $recentSuratKeluar,
            'notifikasi' => $notifikasi, // Tambahkan notifikasi di sini
        ];
        return view('layout.dashboard_karyawan',$data);
    }
}
