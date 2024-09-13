<?php

namespace App\Http\Controllers;

use App\Models\RekapitulasiSurat;
use App\Models\Surat;
use Illuminate\Http\Request;

class RekapitulasiSuratController extends Controller
{
    // Method untuk menampilkan data rekapitulasi berdasarkan tahun yang dipilih
    public function index(Request $request)
    {
        // Ambil tahun dari request, jika tidak ada gunakan tahun saat ini
        $tahun = $request->input('tahun');
        $showTable = $request->has('tahun');

        // Buat array untuk menampung data bulan
        $bulan = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];

        $rekapitulasi = [];

        foreach ($bulan as $index => $namaBulan) {
            $bulanKe = $index + 1;

            $rekapitulasi[$index] = (object)[
                'bulan' => $namaBulan,
                'total_surat_masuk' => Surat::where('status', 'Masuk')
                                            ->whereYear('tanggal', $tahun)
                                            ->whereMonth('tanggal', $bulanKe)
                                            ->count(),
                'total_surat_keluar' => Surat::where('status', 'Keluar')
                                             ->whereYear('tanggal', $tahun)
                                             ->whereMonth('tanggal', $bulanKe)
                                             ->count(),
            ];
        }

        return view('layout.rekapitulasi', compact('rekapitulasi', 'tahun', 'bulan','showTable'));
    }
}
