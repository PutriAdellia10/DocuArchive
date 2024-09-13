<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Instansi;
use App\Models\SifatSurat;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporanMasuk(Request $request)
{
    $tanggalAwal = $request->input('tanggal_awal');
    $tanggalAkhir = $request->input('tanggal_akhir');

    // Mengambil data laporan dengan status 'Masuk' dan filter tanggal
    $query = Laporan::where('status', 'Masuk');

    if ($tanggalAwal && $tanggalAkhir) {
        $query->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir]);
    }

    $laporans = $query->get();
    $instansi = Instansi::all();
    $sifatSurat = SifatSurat::all();

    // Mengembalikan view untuk laporan masuk
    return view('layout.laporanmasuk', compact('laporans','instansi','sifatSurat'));
}
    // Menampilkan laporan keluar
    public function laporanKeluar()
    {
        // Mengambil data laporan dengan status 'Keluar'
        $laporans = Laporan::where('status', 'Keluar')->get();

        // Mengembalikan view untuk laporan keluar
        return view('laporan.keluar', compact('laporans'));
    }
}
