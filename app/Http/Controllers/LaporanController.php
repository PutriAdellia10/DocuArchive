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

    // Peran Admin
    if ($user->peran === 'Admin') {
        // Admin dapat melihat semua surat masuk dan keluar dengan status disposisi 'Selesai'
        $suratMasuk = $query->where('status_disposisi', 'Selesai')->get();
        $suratKeluar = Surat::where('status', 'Keluar')
        ->where('status_disposisi', 'Selesai')
        ->whereDoesntHave('pengirim', function ($query) {
            $query->where('peran', 'Sekretariat','Admin');
        })
        ->get();

        $suratMasuk = $suratMasuk->merge($suratKeluar);
    }

    // Peran Sekretariat
    elseif ($user->peran === 'Sekretariat') {
        // Sekretariat melihat surat masuk dengan disposisi 'Selesai'
        $suratMasuk = $query->where('status_disposisi', 'Selesai')->get();

        // Surat keluar yang bukan dari Sekretariat
        $suratKeluar = Surat::where('status', 'Keluar')
                            ->where('status_disposisi', 'Selesai')
                            ->whereDoesntHave('pengirim', function ($query) {
                                $query->where('peran', 'Sekretariat','Admin');
                            })
                            ->get();

        $suratMasuk = $suratMasuk->merge($suratKeluar);
    }

    // Peran Pimpinan
    elseif ($user->peran === 'Pimpinan') {
        $suratMasuk = $query->where('status_disposisi', 'Selesai')->get();

        // Surat keluar yang bukan dari Sekretariat
        $suratKeluar = Surat::where('status', 'Keluar')
                            ->where('status_disposisi', 'Selesai')
                            ->whereDoesntHave('pengirim', function ($query) {
                                $query->where('peran', 'Sekretariat','Admin');
                            })
                            ->get();

        $suratMasuk = $suratMasuk->merge($suratKeluar);
    }

    // Jika peran tidak dikenal
    else {
        $suratMasuk = collect(); // Kembalikan koleksi kosong
    }

    // Mengambil data dengan relasi instansi dan sifat surat
    $surats = $suratMasuk->load(['instansi', 'sifatSurat']);
    $totalSuratMasuk = $surats->count();

    // Mengembalikan view untuk laporan masuk dengan data surat yang sudah difilter
    return view('layout.laporanmasuk', compact('surats', 'totalSuratMasuk'));
}

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

    // Peran Admin
    if ($user->peran === 'Admin') {
        $suratKeluar = $query->where('status_disposisi', 'Selesai')
        ->whereDoesntHave('pengirim', function ($query) {
            $query->where('peran', 'Karyawan');
        })
        ->get();
    }

    // Peran Sekretariat
    elseif ($user->peran === 'Sekretariat') {
        // Sekretariat dapat melihat surat keluar dengan status disposisi 'Selesai'
        // dan bukan dari pengguna dengan peran 'Karyawan'
        $suratKeluar = $query->where('status_disposisi', 'Selesai')
            ->whereDoesntHave('pengirim', function ($query) {
                $query->where('peran', 'Karyawan');
            })
            ->get();
    }

    // Peran Pimpinan
    elseif ($user->peran === 'Pimpinan') {
        $suratKeluar = $query->where('status_disposisi', 'Selesai')
        ->whereDoesntHave('pengirim', function ($query) {
            $query->where('peran', 'Karyawan');
        })
        ->get();
    }

    // Jika peran tidak dikenal
    else {
        $suratKeluar = collect(); // Kembalikan koleksi kosong
    }

    // Mengambil data dengan relasi instansi dan sifat surat
    $surats = $suratKeluar->load(['instansi', 'sifatSurat']);
    $totalSuratKeluar = $surats->count();

    // Mengembalikan view untuk laporan keluar dengan data surat yang sudah difilter
    return view('layout.laporankeluar', compact('surats', 'totalSuratKeluar'));
}
}
