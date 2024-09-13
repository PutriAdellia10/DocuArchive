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
            'surat_masuk_count' => Surat::where('status', 'Masuk')->count(),
            'surat_keluar_count' => Surat::where('status', 'Keluar')->count(),
            'disposisi_aktif_count' => Disposisi::where('status', 'Aktif')->count(),
            'aktivitas_terbaru' => [
                'Surat Masuk baru diterima pada tanggal 21 Agustus 2024.',
                'Disposisi baru dibuat pada tanggal 19 Agustus 2024.',
            ],
        ];

        // Return ke view dashboard_sekretariat dengan data yang diambil
        return view('layout.dashboard_sekretariat', $data);
    }
}
