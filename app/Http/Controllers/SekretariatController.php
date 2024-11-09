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

        // Total Surat Masuk dengan disposisi 'Selesai'
        $totalSuratMasukSelesai = Surat::where('status', 'Masuk')
            ->where('status_disposisi', 'Selesai')
            ->count();

        // Total Surat Keluar dengan disposisi 'Selesai' yang tidak dibuat oleh Karyawan
        $totalSuratKeluarSelesai = Surat::where('status', 'Keluar')
            ->where('status_disposisi', 'Selesai')
            ->whereDoesntHave('pengirim', function($query) {
                $query->where('peran', 'Karyawan');
            })
            ->count();

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
            'totalSuratMasukSelesai' => $totalSuratMasukSelesai,
            'totalSuratKeluarSelesai' => $totalSuratKeluarSelesai,
            'totalDisposisiAktif' => $totalDisposisiAktif,
            'totalSuratPerTahun' => $totalSuratPerTahun,
        ];

        // Return ke view dashboard_sekretariat dengan data yang diambil
        return view('layout.dashboard_sekretariat', $data);
    }
}
