<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
class AdminController extends Controller
{
    public function index()
    {
        // Contoh pengambilan data untuk dashboard admin, bisa diubah sesuai kebutuhan
        $data = [
            'title' => 'Dashboard Admin',
            // Misalkan mengambil data pengguna atau laporan untuk ditampilkan di dashboard
            'pengguna' => \App\Models\User::all(),
            'totalSuratMasuk' => Surat::where('status', 'Masuk')->count(),
            'totalSuratKeluar' => Surat::where('status', 'Keluar')->count(),
        ];

        // Return ke view dashboard_admin dengan data yang diambil
        return view('layout.dashboard_admin', $data);
    }
}
