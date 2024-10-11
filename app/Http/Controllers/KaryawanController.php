<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
class KaryawanController extends Controller
{
    public function index()
    {
        $data = [
            'totalSuratMasuk' => Surat::where('status', 'Masuk')->count(),
            'totalSuratKeluar' => Surat::where('status', 'Keluar')->count(),
        ];
        return view('layout.dashboard_karyawan',$data);
    }
}
