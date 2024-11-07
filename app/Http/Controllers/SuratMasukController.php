<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuratMasukController extends Controller
{
    // Menampilkan daftar surat masuk
    public function index()
    {
        $user = Auth::user();

        if ($user->peran == 'Karyawan') {
            $suratMasuk = SuratMasuk::where('pengirim_id', $user->id)->get();
            return view('surat.masuk_kar', compact('suratMasuk')); // View untuk Karyawan
        } elseif ($user->peran == 'Pimpinan') {
            $suratMasuk = SuratMasuk::all();
            return view('surat.masuk_pim', compact('suratMasuk')); // View untuk Pimpinan
        } elseif ($user->peran == 'Sekretariat') {
            $suratMasuk = SuratMasuk::all();
            return view('surat.masuk_sekre', compact('suratMasuk')); // View untuk Sekretariat
        } elseif ($user->peran == 'Admin') {
            $suratMasuk = SuratMasuk::all(); // Admin melihat semua surat masuk
            return view('surat.masuk_admin', compact('suratMasuk')); // View untuk Admin
        } else {
            return abort(403); // Akses ditolak jika peran tidak dikenali
        }
    }
    // Menampilkan form untuk membuat surat masuk baru
    public function create()
    {
        $pengirims = User::all(); // Assuming you have a Pengirim model
        $instansis = Instansi::all(); // Assuming you have an Instansi model
        return view('your-view', compact('pengirims', 'instansis'));

    }

    // Menyimpan surat masuk baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'no_surat' => 'required|string|max:50',
            'pengirim_id' => 'nullable|integer',
            'instansi_id' => 'nullable|integer',
            'nama_pengirim_eksternal' => 'nullable|string|max:255',
            'kontak_pengirim_eksternal' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'subjek' => 'required|string|max:255',
            'isi' => 'required|string',
            'lampiran' => 'nullable|string|max:255',
            'status_disposisi' => 'required|in:Belum Diproses,Diproses,Selesai',
            'catatan' => 'nullable|string',
            'status_arsip' => 'required|in:Arsip,Tidak Arsip',
        ]);

        SuratMasuk::create($request->all());
        return redirect()->route('surat-masuk.index')->with('success', 'Surat masuk berhasil dibuat.');
    }

    // Menampilkan detail surat masuk
    public function show(SuratMasuk $suratMasuk)
    {
        return view('surat_masuk.show', compact('suratMasuk'));
    }

    // Menampilkan form untuk mengedit surat masuk
    public function edit(SuratMasuk $suratMasuk)
    {
        return view('surat_masuk.edit', compact('suratMasuk'));
    }

    // Memperbarui surat masuk di database
    public function update(Request $request, SuratMasuk $suratMasuk)
    {
        $request->validate([
            'no_surat' => 'required|string|max:50',
            'pengirim_id' => 'nullable|integer',
            'instansi_id' => 'nullable|integer',
            'nama_pengirim_eksternal' => 'nullable|string|max:255',
            'kontak_pengirim_eksternal' => 'nullable|string|max:255',
            'tanggal' => 'nullable|date',
            'subjek' => 'required|string|max:255',
            'isi' => 'required|string',
            'lampiran' => 'nullable|string|max:255',
            'status_disposisi' => 'required|in:Belum Diproses,Diproses,Selesai',
            'catatan' => 'nullable|string',
            'status_arsip' => 'required|in:Arsip,Tidak Arsip',
        ]);

        $suratMasuk->update($request->all());
        return redirect()->route('surat-masuk.index')->with('success', 'Surat masuk berhasil diperbarui.');
    }

    // Menghapus surat masuk dari database
    public function destroy(SuratMasuk $suratMasuk)
    {
        $suratMasuk->delete();
        return redirect()->route('surat-masuk.index')->with('success', 'Surat masuk berhasil dihapus.');
    }
     // Form untuk memberi disposisi (untuk Pimpinan)
     public function disposisiForm($id)
     {
         $surat = SuratMasuk::findOrFail($id);
         return view('suratMasuk.disposisi', compact('surat'));
     }

     // Memproses disposisi surat masuk
     public function disposisi(Request $request, $id)
     {
         $surat = SuratMasuk::findOrFail($id);
         $surat->status_disposisi = 'Diproses';
         $surat->catatan = $request->catatan;
         $surat->save();

         return redirect()->route('suratMasuk.index')->with('success', 'Disposisi telah diberikan.');
     }

     // Melakukan tindak lanjut pada surat (untuk Karyawan)
     public function tindakLanjutForm($id)
     {
         $surat = SuratMasuk::findOrFail($id);
         return view('suratMasuk.tindakLanjut', compact('surat'));
     }

     // Memproses tindak lanjut dari Karyawan
     public function tindakLanjut(Request $request, $id)
     {
         $surat = SuratMasuk::findOrFail($id);
         $surat->status_disposisi = 'Selesai';
         $surat->catatan = $request->catatan;
         $surat->save();

         return redirect()->route('suratMasuk.index')->with('success', 'Tindak lanjut telah dilaporkan.');
     }

     // Mengarsipkan surat masuk
     public function arsipkan($id)
     {
         $surat = SuratMasuk::findOrFail($id);
         $surat->status = 'Diarsipkan';
         $surat->save();

         return redirect()->route('suratMasuk.index')->with('success', 'Surat telah diarsipkan.');
     }
}
