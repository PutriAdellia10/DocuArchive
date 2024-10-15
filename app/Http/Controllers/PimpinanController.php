<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Instansi;

class PimpinanController extends Controller
{
    public function index()
    {
        $data = [
            'totalSuratMasuk' => Surat::where('status', 'Masuk')->count(),
            'totalSuratKeluar' => Surat::where('status', 'Keluar')->count(),
            'totalInstansi' => Instansi::count(),
        ];
        return view('layout.dashboard_pimpinan',$data);
    }
}
