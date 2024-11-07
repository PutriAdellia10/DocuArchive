<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use App\Models\Instansi;
use App\Models\SifatSurat;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    // Mengambil data surat masuk
    public function laporanMasuk(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $user = auth()->user(); // Ambil data user yang sedang login

        // Membuat query untuk mengambil data Surat berdasarkan status 'Masuk'
        $query = Surat::where('status', 'Masuk');

        // Filter berdasarkan tanggal jika ada
        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
        }

        // Logika untuk peran pengguna
        if ($user->peran == 'Sekretariat') {
            // Ambil surat dengan status 'Masuk' dan status disposisi 'Selesai'
            $suratMasuk = $query->where('status_disposisi', 'Selesai')->get();

            // Ambil surat dengan status 'Keluar' yang bukan dibuat oleh pengguna dengan peran 'Sekretariat' dan disposisi 'Selesai'
            $suratKeluar = Surat::where('status', 'Keluar')
                                ->where('status_disposisi', 'Selesai')
                                ->whereDoesntHave('pengirim', function($query) {
                                    $query->where('peran', 'Sekretariat');
                                })
                                ->get();

            // Gabungkan surat masuk dan keluar yang disposisinya 'Selesai'
            $suratMasuk = $suratMasuk->merge($suratKeluar);
        } else {
            // Jika bukan Sekretariat, hanya ambil surat masuk dengan status disposisi 'Selesai'
            $suratMasuk = $query->where('status_disposisi', 'Selesai')->get();
        }

        // Mengambil data dengan relasi instansi dan sifat surat
        $surats = $suratMasuk->load(['instansi', 'sifatSurat']);
        $totalSuratMasuk = $surats->count();
        // Mengembalikan view untuk laporan masuk dengan data surat yang sudah difilter
        return view('layout.laporanmasuk', compact('surats','totalSuratMasuk'));
    }

    // Mengambil data surat keluar
    public function laporanKeluar(Request $request)
{
    $tanggalAwal = $request->input('tanggal_awal');
    $tanggalAkhir = $request->input('tanggal_akhir');

    $user = auth()->user(); // Ambil data user yang sedang login

    // Membuat query untuk mengambil data Surat berdasarkan status 'Keluar'
    $query = Surat::where('status', 'Keluar');

    // Filter berdasarkan tanggal jika ada
    if ($tanggalAwal && $tanggalAkhir) {
        $query->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
    }

    // Logika untuk peran pengguna
    if ($user->peran == 'Sekretariat') {
        // Ambil surat keluar dengan status disposisi 'Selesai' saja
        $suratKeluar = $query->where('status_disposisi', 'Selesai')->get();

        // Ambil surat keluar yang tidak dikirim oleh pengguna dengan peran 'Karyawan'
        $suratKeluar = $query->where('status_disposisi', 'Selesai') // hanya status 'Selesai'
            ->whereNotIn('pengirim_id', function($query) {
                $query->select('id')
                      ->from('pengguna')
                      ->where('peran', 'Karyawan');
            })
            ->get();
    } else {
        // Jika bukan Sekretariat, hanya ambil surat keluar dengan status disposisi 'Selesai'
        $suratKeluar = $query->where('status_disposisi', 'Selesai')->get();
    }

    // Mengambil data dengan relasi instansi dan sifat surat
    $surats = $suratKeluar->load(['instansi', 'sifatSurat']);
    $totalSuratKeluar = $surats->count();
    // Mengembalikan view untuk laporan keluar dengan data surat yang sudah difilter
    return view('layout.laporankeluar', compact('surats','totalSuratKeluar'));
}

}
