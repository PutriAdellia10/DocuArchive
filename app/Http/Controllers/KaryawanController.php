<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Disposisi;
use App\Models\Notifikasi;
use App\Models\Instansi;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index()
    {
        // Ambil 5 surat masuk terbaru
        $recentSuratMasuk = Surat::where('status', 'Masuk')
        ->whereIn('status_disposisi', ['Diproses', 'Selesai'])
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

        // Ambil 5 surat keluar terbaru
        $recentSuratKeluar =Surat::where('status', 'Masuk')
        ->whereIn('status_disposisi', ['Diproses', 'Selesai'])
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();
        // Ambil notifikasi terbaru
        $notifikasi = Notifikasi::orderBy('dibuat_pada', 'desc')
            ->take(5)
            ->get();

            // query untuk menghitung total surat
            $totalSuratPerTahun = DB::table('surat')
            ->whereYear('tanggal_surat', date('Y')) // Menghitung surat per tahun ini
            ->count(); // Menghitung total surat secara langsung

            // Total Surat Masuk dengan disposisi 'Selesai'
            $totalSuratMasukSelesai = Surat::whereIn('status', ['Masuk', 'Keluar'])
            ->where('status_disposisi', 'Selesai')
            ->whereDoesntHave('pengirim', function($query) {
                $query->where('peran', 'Karyawan'); // Memastikan surat masuk dikirim oleh Karyawan
            })
            ->count();

            // Total Surat Keluar dengan disposisi 'Selesai' yang tidak dibuat oleh Karyawan
            $totalSuratKeluarSelesai = Surat::where('status', 'Keluar')
            ->where('status_disposisi', 'Selesai')
            ->whereDoesntHave('pengirim', function($query) {
                $query->where('peran', 'Sekretariat');
            })
            ->count();

            // Total Disposisi Aktif (status 'Masuk' atau 'Keluar' dan disposisi 'Belum Diproses' atau 'Diproses')
            $totalDisposisiAktif = Surat::whereIn('status', ['Masuk', 'Keluar'])
            ->whereIn('status_disposisi', ['Belum Diproses', 'Diproses'])
            ->count();
        // Contoh pengambilan data untuk dashboard admin, bisa diubah sesuai kebutuhan
        $data = [
            'title' => 'Dashboard Karyawan',
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
        return view('layout.dashboard_karyawan',$data);
    }
}
