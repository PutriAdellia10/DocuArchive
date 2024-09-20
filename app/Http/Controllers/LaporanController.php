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

        // Mengambil data dari tabel surat dengan status 'Masuk'
        $query = Surat::where('status', 'Masuk');

        // Filter berdasarkan tanggal jika ada
        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
        }

        // Mengambil data dengan relasi instansi dan sifat surat
        $surats = $query->with(['instansi', 'sifatSurat'])->get();

        // Mengembalikan view untuk laporan masuk
        return view('layout.laporanmasuk', compact('surats'));
    }

    // Mengambil data surat keluar
    public function laporanKeluar(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        // Mengambil data dari tabel surat dengan status 'Keluar'
        $query = Surat::where('status', 'Keluar');

        // Filter berdasarkan tanggal jika ada
        if ($tanggalAwal && $tanggalAkhir) {
            $query->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
        }

        // Mengambil data dengan relasi instansi dan sifat surat
        $surats = $query->with(['instansi', 'sifatSurat'])->get();

        // Mengembalikan view untuk laporan keluar
        return view('layout.laporankeluar', compact('surats'));
    }
}
