<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Disposisi;
use App\Models\Notifikasi;
use App\Models\Instansi;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SekretariatController extends Controller
{
    // Menampilkan halaman dashboard sekretariat
    public function index()
    {
        // Ambil 2 surat masuk terbaru
        $recentSuratMasuk = Surat::where('status', 'Masuk')
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        // Ambil 2 surat keluar terbaru
        $recentSuratKeluar = Surat::where('status', 'Keluar')
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

        // Ambil 5 notifikasi terbaru
        $notifikasi = Notifikasi::orderBy('dibuat_pada', 'desc')
            ->take(5)
            ->get();

        // Hitung total surat per tahun ini
        $totalSuratPerTahun = Surat::whereYear('tanggal_surat', date('Y'))
            ->count();

         // Ambil koleksi surat masuk
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

        // Data yang akan diteruskan ke view
        $data = [
            'title' => 'Dashboard Sekretariat',
            'pengguna' => User::all(),
            'totalInstansi' => Instansi::count(),
            'instansiList' => Instansi::all(),
            'recentSuratMasuk' => $recentSuratMasuk,
            'recentSuratKeluar' => $recentSuratKeluar,
            'notifikasi' => $notifikasi,
            'totalSuratKeluarSelesai' => $totalSuratKeluarSelesai,
            'total_surat_gabungan' => $suratGabungan->count(),
            'totalDisposisiAktif' => $totalDisposisiAktif,
            'totalSuratPerTahun' => $totalSuratPerTahun,
        ];

        // Return ke view dashboard_sekretariat dengan data yang diambil
        return view('layout.dashboard_sekretariat', $data);
    }
}
