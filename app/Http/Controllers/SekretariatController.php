<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat; // Model Surat
use App\Models\Disposisi; // Model Disposisi

class SekretariatController extends Controller
{
    // Menampilkan halaman dashboard sekretariat
    public function index()
    {
        // Mengambil data untuk dashboard
        $data = [
            'totalSuratMasuk' => Surat::where('status', 'Masuk')->count(),
            'totalSuratKeluar' => Surat::where('status', 'Keluar')->count(),
        ];

        // Return ke view dashboard_sekretariat dengan data yang diambil
        return view('layout.dashboard_sekretariat', $data);
    }
}
