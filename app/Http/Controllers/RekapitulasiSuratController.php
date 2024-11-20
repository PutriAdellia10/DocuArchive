<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;

class RekapitulasiSuratController extends Controller
{
    // Method untuk menampilkan data rekapitulasi berdasarkan tahun yang dipilih
    public function index(Request $request)
    {
        // Ambil tahun dari request, jika tidak ada gunakan tahun saat ini
        $tahun = $request->input('tahun', date('Y'));
        $showTable = $request->has('tahun');

        // Buat array untuk menampung data bulan
        $bulan = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];

        $rekapitulasi = [];

        foreach ($bulan as $index => $namaBulan) {
            $bulanKe = $index + 1;

            // Ambil koleksi surat masuk
            $suratMasuk = Surat::where('status', 'Masuk')
                ->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulanKe)
                ->whereIn('status_disposisi', ['Selesai'])
                ->whereNotIn('pengirim_id', function ($query) {
                    $query->select('id')
                          ->from('pengguna')
                          ->whereIn('peran', ['Sekretariat', 'Admin']);
                })
                ->get();

            // Ambil koleksi surat keluar
            $suratKeluar = Surat::where('status', 'Keluar')
                ->whereYear('tanggal', $tahun)
                ->whereMonth('tanggal', $bulanKe)
                ->whereIn('status_disposisi', ['Selesai'])
                ->whereNotIn('pengirim_id', function ($query) {
                    $query->select('id')
                          ->from('pengguna')
                          ->whereIn('peran', ['Sekretariat', 'Admin']);
                })
                ->get();

            // Gabungkan koleksi surat masuk dan surat keluar
            $suratGabungan = $suratMasuk->merge($suratKeluar);

            // Hitung total surat masuk dan keluar setelah digabung
            $totalSuratMasuk = $suratMasuk->count();
            $totalSuratKeluar = $suratKeluar->count();

            $rekapitulasi[] = (object)[
                'bulan' => $namaBulan,
                'total_surat_masuk' => $totalSuratMasuk,
                'total_surat_keluar' => $totalSuratKeluar,
                'total_surat_gabungan' => $suratGabungan->count(), // jika ingin total gabungan
            ];
        }

        return view('layout.rekapitulasi', compact('rekapitulasi', 'tahun', 'bulan', 'showTable'));
    }
}
