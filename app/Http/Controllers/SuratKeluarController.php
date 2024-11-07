<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratKeluarController extends Controller
{
    // Menampilkan daftar surat keluar
    public function index()
    {
        $user = Auth::user();

        if ($user->peran == 'Karyawan') {
            $suratKeluar = SuratKeluar::where('tujuan', $user->id)->get();
            return view('surat.keluar_kar', compact('suratKeluar')); // View untuk Karyawan
        } elseif ($user->peran == 'Pimpinan') {
            $suratKeluar = SuratKeluar::where('status_pengiriman', 'Belum Diproses')->get();
            return view('surat.keluar_pim', compact('suratKeluar')); // View untuk Pimpinan
        } elseif ($user->peran == 'Sekretariat') {
            $suratKeluar = SuratKeluar::all();
            return view('surat.keluar_sekre', compact('suratKeluar')); // View untuk Sekretariat
        } elseif ($user->peran == 'Admin') {
            $suratKeluar = SuratKeluar::all(); // Admin melihat semua surat masuk
            return view('surat.keluar_admin', compact('suratKeluar')); // View untuk Admin
        } else {
            return abort(403); // Akses ditolak jika peran tidak dikenali
        }
    }

    // Menampilkan form untuk membuat surat keluar baru
    public function create()
    {
        return view('surat_keluar.create');
    }

    // Menyimpan surat keluar baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'no_surat' => 'required|string|max:50',
            'tanggal_pembuatan' => 'required|date',
            'judul_surat' => 'required|string|max:255',
            'isi' => 'required|string',
            'tujuan' => 'required|string',
            'lampiran' => 'nullable|string|max:255',
            'status_review' => 'required|in:Belum Ditandatangani,Sudah Ditandatangani',
            'status_pengiriman' => 'required|in:Dalam Proses,Terkirim',
            'status_arsip' => 'required|in:Arsip,Tidak Arsip',
        ]);

        try {
            SuratKeluar::create($request->all());
            return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan surat keluar.');
        }
    }
    // Menampilkan detail surat keluar
    public function show(SuratKeluar $suratKeluar)
    {
        return view('surat_keluar.show', compact('suratKeluar'));
    }

    // Menampilkan form untuk mengedit surat keluar
    public function edit(SuratKeluar $suratKeluar)
    {
        return view('surat_keluar.edit', compact('suratKeluar'));
    }

    // Memperbarui surat keluar di database
    public function update(Request $request, SuratKeluar $suratKeluar)
    {
        $request->validate([
            'no_surat' => 'required|string|max:50',
            'tanggal_pembuatan' => 'required|date',
            'judul_surat' => 'required|string|max:255',
            'isi' => 'required|string',
            'tujuan' => 'required|string',
            'lampiran' => 'nullable|string|max:255',
            'status_review' => 'required|in:Belum Ditandatangani,Sudah Ditandatangani',
            'status_pengiriman' => 'required|in:Dalam Proses,Terkirim',
            'status_arsip' => 'required|in:Arsip,Tidak Arsip',
        ]);

        $suratKeluar->update($request->all());
        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil diperbarui.');
    }

    // Menghapus surat keluar dari database
    public function destroy(SuratKeluar $suratKeluar)
    {
        $suratKeluar->delete();
        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil dihapus.');
    }

    // Form untuk memberikan review (untuk Pimpinan)
    public function reviewForm($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        return view('suratKeluar.review', compact('surat'));
    }

    // Memproses review surat keluar
    public function review(Request $request, $id)
    {
        $surat = SuratKeluar::findOrFail($id);
        $surat->status_review = 'Sudah Ditandatangani';
        $surat->save();

        return redirect()->route('suratKeluar.index')->with('success', 'Surat telah ditandatangani.');
    }

    // Form untuk tindak lanjut pengiriman surat (untuk Sekretariat)
    public function pengirimanForm($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        return view('suratKeluar.pengiriman', compact('surat'));
    }

    // Memproses pengiriman surat keluar
    public function kirim(Request $request, $id)
    {
        $surat = SuratKeluar::findOrFail($id);
        $surat->status_pengiriman = $request->status;
        $surat->save();

        return redirect()->route('suratKeluar.index')->with('success', 'Surat telah dikirim.');
    }

    // Mengarsipkan surat keluar
    public function arsipkan($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        $surat->status = 'Diarsipkan';
        $surat->save();

        return redirect()->route('suratKeluar.index')->with('success', 'Surat telah diarsipkan.');
    }
}
