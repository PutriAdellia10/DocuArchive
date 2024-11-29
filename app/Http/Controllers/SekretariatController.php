<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Disposisi;
use App\Models\Notifikasi;
use App\Models\Instansi;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SekretariatController extends Controller
{
    public function index()
    {
        $disposisiData = DB::table('disposisi')
            ->join('surat', 'disposisi.surat_id', '=', 'surat.id') // Join dengan tabel surat berdasarkan surat_id
            ->select('disposisi.surat_id', 'surat.perihal') // Pilih surat_id dan perihal dari tabel surat
            ->selectRaw("
                MAX(CASE WHEN kepada = 'Sekretariat' THEN disposisi.created_at END) as sekre_created_at,
                MAX(CASE WHEN kepada = 'Pimpinan' THEN disposisi.updated_at END) as pimpinan_updated_at
            ")
            ->groupBy('disposisi.surat_id', 'surat.perihal') // Kelompokkan berdasarkan surat_id dan perihal
            ->get()
            ->map(function ($disposisi) {
                // Ambil waktu dari Sekretariat dan Pimpinan
                $sekreTime = $disposisi->sekre_created_at ? Carbon::parse($disposisi->sekre_created_at) : null;
                $pimpinanTime = $disposisi->pimpinan_updated_at ? Carbon::parse($disposisi->pimpinan_updated_at) : null;

                // Hitung waktu penyelesaian dalam format bahasa Indonesia
                if ($sekreTime && $pimpinanTime) {
                    $difference = $pimpinanTime->diff($sekreTime);
                    $disposisi->waktu_penyelesaian = sprintf(
                        '%d jam %d menit',
                        $difference->h,
                        $difference->i
                    );
                    // Tambahkan waktu penyelesaian dalam menit untuk perhitungan rata-rata
                    $disposisi->waktu_penyelesaian_dalam_menit = ($difference->h * 60) + $difference->i;
                } else {
                    $disposisi->waktu_penyelesaian = 'Belum Selesai';
                    $disposisi->waktu_penyelesaian_dalam_menit = 0;
                }

                return $disposisi;
            });

       // Menghitung rata-rata waktu penyelesaian
            $totalWaktu = $disposisiData->sum('waktu_penyelesaian_dalam_menit');
            $totalDisposisiSelesai = $disposisiData->where('waktu_penyelesaian_dalam_menit', '>', 0)->count();

            $rataWaktuPenyelesaian = $totalDisposisiSelesai > 0 ? $totalWaktu / $totalDisposisiSelesai : 0;

            // Ubah rata-rata waktu ke dalam format jam dan menit
            $jam = floor($rataWaktuPenyelesaian / 60);
            $menit = $rataWaktuPenyelesaian % 60;
            $rataWaktuPenyelesaianFormat = sprintf('%d jam %d menit', $jam, $menit);

            // Tentukan waktu target dalam menit (misalnya 120 menit = 2 jam)
            $waktuTarget = 120;

            // Hitung persentase waktu penyelesaian dibandingkan dengan target
            $persenPenyelesaian = ($rataWaktuPenyelesaian / $waktuTarget) * 100;
            $persenPenyelesaianFormat = number_format($persenPenyelesaian, 2) . '%';

                // Ambil 5 surat masuk terbaru
            $recentSuratMasuk = Surat::where('status', 'Masuk')
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get();

            // Ambil 5 surat keluar terbaru
            $recentsuratKeluar = Surat::with(['tujuanPengguna', 'tujuanInstansi'])
            ->where('status', 'Keluar')
            ->whereNotIn('pengirim_id', function ($query) {
                $query->select('id')
                    ->from('pengguna')
                    ->whereIn('peran', ['Sekretariat']);
            })
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

            // Gabungkan Surat Masuk dan Surat Keluar
            $resentGabungan = $recentSuratMasuk->merge($recentsuratKeluar);
            // Ambil 5 surat keluar terbaru
            $recentsurat= Surat::with(['tujuanPengguna', 'tujuanInstansi'])
            ->where('status', 'Keluar')
            ->whereNotIn('pengirim_id', function ($query) {
                $query->select('id')
                    ->from('pengguna')
                    ->whereIn('peran', ['Karyawan']);
            })
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        // Query untuk menghitung total surat
        $totalSuratPerTahun = DB::table('surat')
            ->whereYear('tanggal_surat', date('Y')) // Menghitung surat per tahun ini
            ->count(); // Menghitung total surat secara langsung

        // Total Surat Masuk dengan disposisi 'Selesai'
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

        // Data yang dikirim ke view
        $data = [
            'title' => 'Dashboard Admin',
            'pengguna' => User::all(),
            'totalInstansi' => Instansi::count(),
            'instansiList' => Instansi::all(),
            'recentSurat' => $recentsurat,
            'recentGabungan' =>$resentGabungan,
            'total_surat_gabungan' => $suratGabungan->count(),
            'totalSuratKeluarSelesai' => $totalSuratKeluarSelesai,
            'totalDisposisiAktif' => $totalDisposisiAktif,
            'totalSuratPerTahun' => $totalSuratPerTahun,
            'disposisiData' => $disposisiData, // Tambahkan data disposisi ke dalam data view
            'rataWaktuPenyelesaian' => $rataWaktuPenyelesaianFormat, // Tambahkan rata-rata waktu penyelesaian
            'persenPenyelesaianFormat'=> $persenPenyelesaianFormat,
        ];

        // Kembali ke view dengan data yang diambil
        return view('layout.dashboard_sekretariat', $data);
    }
}
