<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Instansi;
class AdminController extends Controller
{
    public function index()
    {
        // Ambil 5 surat masuk terbaru
        $recentSuratMasuk = Surat::where('status', 'Masuk')
        ->orderBy('created_at', 'desc')
        ->take(1)
        ->get();

        $recentSuratKeluar = Surat::where('status', 'Keluar')
        ->orderBy('created_at', 'desc')
        ->take(1)
        ->get();


        // Contoh pengambilan data untuk dashboard admin, bisa diubah sesuai kebutuhan
        $data = [
            'title' => 'Dashboard Admin',
            // Misalkan mengambil data pengguna atau laporan untuk ditampilkan di dashboard
            'pengguna' => \App\Models\User::all(),
            'totalSuratMasuk' => Surat::where('status', 'Masuk')->count(),
            'totalSuratKeluar' => Surat::where('status', 'Keluar')->count(),
            'totalInstansi' => Instansi::count(),
            'instansiList' => Instansi::all(),
            'recentSuratMasuk'=> $recentSuratMasuk,
            'recentSuratKeluar'=> $recentSuratKeluar,
        ];


        // Return ke view dashboard_admin dengan data yang diambil
        return view('layout.dashboard_admin', $data);
    }
}
