<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Instansi;
use App\Models\SifatSurat;
use App\Models\Disposisi;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class SuratController extends Controller
{
    // Surat Masuk Methods

     public function indexMasuk()
    {
        $user = Auth::user();
        $instansi = Instansi::all(); // Ambil semua instansi
        $sifatSurat = SifatSurat::all(); // Ambil semua sifat surat
        $pengguna = User::all();
        // Cek peran pengguna dan ambil surat keluar yang sesuai
        if ($user->peran == 'Karyawan') {
            $suratMasuk = Surat::where('status', 'Masuk')
            ->get();
            $suratKeluar = Surat::where('status', 'Keluar')
            ->whereHas('pengirim', function ($query) {
                $query->where('peran', 'Karyawan');
            })
            ->get();
            $suratGabungan = $suratMasuk->merge($suratKeluar);
        return view('surat.masuk_kar', compact('suratGabungan', 'instansi', 'sifatSurat', 'pengguna'));
        } elseif ($user->peran == 'Pimpinan') {
            $suratMasuk = Surat::where('status', 'Masuk')
            ->whereIn('status_disposisi', ['Diproses','Selesai'])
            ->get();
            $suratKeluar = Surat::where('status', 'Keluar')
                ->whereIn('status_disposisi', [ 'Diproses','Selesai'])
                ->whereNotIn('pengirim_id', function($query) {
                    $query->select('id')
                        ->from('pengguna')
                        ->where('peran', 'Sekretariat');
                })
                ->get();
                $suratGabungan = $suratMasuk->merge($suratKeluar);
            return view('surat.masuk', compact('suratGabungan', 'instansi', 'sifatSurat','pengguna'));
        } elseif ($user->peran == 'Sekretariat') {
            $suratMasuk = Surat::where('status', 'Masuk')
            ->get();
            $suratKeluar = Surat::where('status', 'Keluar')
                ->whereDoesntHave('pengirim', function($query) {
                    $query->where('peran', 'Sekretariat');
                })
                ->get();
                $suratGabungan = $suratMasuk->merge($suratKeluar);
            return view('surat.masuk', compact('suratGabungan','instansi', 'sifatSurat','pengguna')); // View untuk Sekretariat
        } elseif ($user->peran == 'Admin') {
            $suratMasuk = Surat::where('status', 'Masuk')
            ->get();
            $suratKeluar = Surat::where('status', 'Keluar')
                ->whereNotIn('pengirim_id', function($query) {
                    $query->select('id')
                        ->from('pengguna')
                        ->where('peran', 'Sekretariat');
                })
                ->get();
                $suratGabungan = $suratMasuk->merge($suratKeluar);
            return view('surat.masuk', compact('suratGabungan','instansi', 'sifatSurat','pengguna')); // View untuk Admin
        } else {
            return abort(403); // Akses ditolak jika peran tidak dikenali
        }
    }
    public function create()
    {
        $instansi = Instansi::all();
        $sifatSurat = SifatSurat::all();

        // Kirimkan newNoAgenda ke view
        return view('suratmasuk.create', compact('instansi', 'sifatSurat'));
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        $disposisiEntries = Disposisi::where('surat_id', $id)->get() ?? collect(); // Ensure it's a collection

        return view('surat.edit', compact('surat', 'disposisiEntries'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'no_surat' => 'required|string|max:255|unique:surat,no_surat',
            'tanggal_surat' => 'required|date',
            'perihal' => 'required|string',
            'konten' => 'required|string',
            'id_sifat_surat' => 'required|integer',
            'id_asal_surat' => 'required|integer',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'status' => 'required|string|in:Masuk,Keluar',
            'pengirim_id' => 'nullable|integer',
            'pengirim_eksternal' => 'nullable|string',
            'tujuan_pengguna_id' => 'nullable|integer',
            'tujuan_instansi_id' => 'nullable|integer',
            'status_pengiriman' => 'nullable|string',
        ]);

        // Generate next no_agenda in format AG001, AG002, etc.
        $lastSurat = Surat::where('no_agenda', 'like', 'AG%')->orderBy('no_agenda', 'desc')->first();
        if ($lastSurat) {
            $lastNumber = (int) substr($lastSurat->no_agenda, 2);
            $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '001';
        }
        $noAgenda = 'AG' . $nextNumber;

        // Simpan file dokumen jika ada
        $path = $request->file('dokumen') ? $request->file('dokumen')->store('dokumen_masuk', 'public') : null;
        $user = auth()->user();

        // Simpan data surat dengan no_agenda yang dihasilkan
        Surat::create([
            'no_agenda' => $noAgenda,
            'tanggal' => $request->tanggal,
            'no_surat' => $request->no_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'perihal' => $request->perihal,
            'konten' => $request->konten,
            'id_sifat_surat' => $request->id_sifat_surat,
            'id_asal_surat' => $request->id_asal_surat,
            'dokumen' => $path,
            'status' => $request->status,
            'created_by' => auth()->id(),
            'pengirim_id' => $user->id,
            'pengirim_eksternal' => $request->pengirim_eksternal,
            'tujuan_pengguna_id' => $request->tujuan_pengguna_id,
            'tujuan_instansi_id' => $request->tujuan_instansi_id,
            'status_pengiriman' => $request->status_pengiriman,
            'status_disposisi' => $request->status_disposisi ?? 'Belum Diproses',
        ]);

        // Redirect atau return response sesuai kebutuhan
        return redirect()->route('surat.index')->with('success', 'Surat berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
         // Validasi input
    $request->validate([
        'no_agenda' => 'required|string',
        'tanggal' => 'required|date',
        'no_surat' => 'required|string|max:255|unique:surat,no_surat,' . $id,
        'tanggal_surat' => 'required|date',
        'perihal' => 'required|string',
        'konten' => 'required|string',
        'id_sifat_surat' => 'required|integer',
        'id_asal_surat' => 'required|integer',
        'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        'status' => 'required|string|in:Masuk,Keluar',
        'pengirim_id' => 'nullable|integer',
        'pengirim_eksternal' => 'nullable|string',
        'tujuan_pengguna_id' => 'nullable|integer',
        'tujuan_instansi_id' => 'nullable|integer',
        'status_pengiriman' => 'nullable|string',
        'status_disposisi' => 'nullable|string',
    ]);

    // Temukan surat yang ingin diperbarui
    $surat = Surat::findOrFail($id);

     // Update data surat
     $surat->update([
        'no_agenda' => $request->no_agenda,
        'tanggal' => $request->tanggal,
        'no_surat' => $request->no_surat,
        'tanggal_surat' => $request->tanggal_surat,
        'perihal' => $request->perihal,
        'konten' => $request->konten,
        'id_sifat_surat' => $request->id_sifat_surat,
        'id_asal_surat' => $request->id_asal_surat,
        'dokumen' => $path,
        'status' => $request->status,
        'pengirim_id' => $request->pengirim_id,
        'pengirim_eksternal' => $request->pengirim_eksternal,
        'tujuan_pengguna_id' => $request->tujuan_pengguna_id,
        'tujuan_instansi_id' => $request->tujuan_instansi_id,
        'status_pengiriman' => $request->status_pengiriman,
        'status_disposisi' => $request->status_disposisi,
    ]);

        // Periksa jika ada file dokumen baru
        if ($request->hasFile('dokumen')) {
            // Hapus file lama jika ada
            if ($surat->dokumen) {
                Storage::delete($surat->dokumen);
            }

            // Simpan file baru
            $path = $request->file('dokumen')->store('dokumen_masuk', 'public');
            $surat->dokumen = $path;
        }

        // Simpan perubahan ke database
        $surat->save();

        return redirect()->route('surat.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        if ($surat->dokumen) {
            Storage::disk('public')->delete($surat->dokumen);
        }
        $surat->delete();
        return redirect()->route('dashboard_karyawan');
    }

    public function show($id)
    {
        // Ambil data surat berdasarkan ID
        $surat = Surat::findOrFail($id);
        $user = Auth::user();

        // Memastikan peran pengguna ada
        if (!$user) {
            return abort(403, 'Pengguna tidak teridentifikasi.');
        }

        // Menyaring akses berdasarkan peran
        if ($user->peran == 'Admin') {
            // Jika Admin, tampilkan semua informasi surat
            return view('crudsurat.detailmasuk', compact('surat'));
        } elseif ($user->peran == 'Sekretariat') {
            // Jika Sekretariat, tampilkan surat
            return view('crudsurat.detailmasuk', compact('surat'));
        } elseif ($user->peran == 'Pimpinan') {
            return view('crudsurat.detailmasuk', compact('surat'));
        } elseif ($user->peran == 'Karyawan') {
            // Jika Karyawan, tampilkan hanya status surat dan instruksi
            return view('crudsurat.detailmasuk_kar', compact('surat'));
        } else {
            // Jika peran tidak teridentifikasi, arahkan ke halaman lain atau tampilkan error
            return abort(403);
        }
    }

    // Surat Keluar Methods

    public function indexKeluar()
    {
        $user = Auth::user();
        $instansi = Instansi::all(); // Ambil semua instansi
        $sifatSurat = SifatSurat::all(); // Ambil semua sifat surat
        $pengguna = User::all();
        // Cek peran pengguna dan ambil surat keluar yang sesuai
        if ($user->peran == 'Karyawan') {
            $suratKeluar = Surat::where('status', 'Keluar')->get();
            $suratKeluar = Surat::whereIn('status_pengiriman', ['Draft', 'Dikirim'])->get();
            return view('surat.keluar_kar', compact('suratKeluar', 'instansi', 'sifatSurat')); // View untuk Karyawan
        } elseif ($user->peran == 'Pimpinan') {
            $suratKeluar = Surat::where('status', 'Keluar')
            ->whereIn('status_disposisi', ['Diproses','Selesai'])
            ->get();
            $suratKeluar = Surat::where('status', 'Keluar')
                ->whereIn('status_disposisi', [ 'Diproses','Selesai'])
                ->whereNotIn('pengirim_id', function($query) {
                    $query->select('id')
                        ->from('pengguna')
                        ->where('peran', 'Karyawan');
                })
                ->get();
            return view('surat.keluar', compact('suratKeluar', 'instansi', 'sifatSurat','pengguna'));
        } elseif ($user->peran == 'Sekretariat') {
            $suratKeluar = Surat::where('status', 'Keluar')
            ->whereIn('status_disposisi', ['Belum Diproses', 'Diproses','Selesai'])
            ->get();
            $suratKeluar = Surat::where('status', 'Keluar')
                ->whereIn('status_disposisi', ['Belum Diproses', 'Diproses','Selesai'])
                ->whereNotIn('pengirim_id', function($query) {
                    $query->select('id')
                        ->from('pengguna')
                        ->where('peran', 'Karyawan');
                })
                ->get();
            return view('surat.keluar', compact('suratKeluar', 'instansi', 'sifatSurat','pengguna')); // View untuk Sekretariat
        } elseif ($user->peran == 'Admin') {
            $suratKeluar = Surat::where('status', 'Keluar')
            ->whereIn('status_disposisi', ['Belum Diproses', 'Diproses','Selesai'])
            ->get();
            $suratKeluar = Surat::where('status', 'Keluar')
                ->whereIn('status_disposisi', ['Belum Diproses', 'Diproses','Selesai'])
                ->whereNotIn('pengirim_id', function($query) {
                    $query->select('id')
                        ->from('pengguna')
                        ->where('peran', 'Karyawan');
                })
                ->get();
            return view('surat.keluar', compact('suratKeluar', 'instansi', 'sifatSurat','pengguna')); // View untuk Admin
        } else {
            return abort(403); // Akses ditolak jika peran tidak dikenali
        }
    }
    public function keluaredit($id)
{
    $surat = Surat::findOrFail($id); // Mengambil model surat berdasarkan ID
    return view('surat.edit', compact('surat')); // Mengirim variabel $surat ke view
}

    public function keluarcreate()
    {
        $instansi = Instansi::all();
        $sifatSurat = SifatSurat::all();
        $pengguna = User::all();
        return view('suratmasuk.create', compact('instansi', 'sifatSurat'));
    }

    public function keluarstore(Request $request)
    {
        // Validasi input
        $request->validate([
            'tanggal' => 'required|date',
            'no_surat' => 'required|string|max:255|unique:surat,no_surat',
            'tanggal_surat' => 'required|date',
            'perihal' => 'required|string',
            'konten' => 'required|string',
            'id_sifat_surat' => 'required|integer',
            'id_asal_surat' => 'nullable|integer',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'status' => 'required|string|in:Masuk,Keluar',
            'pengirim_id' => 'nullable|integer',
            'pengirim_eksternal' => 'nullable|string',
            'tujuan_pengguna_id' => 'nullable|integer',
            'tujuan_instansi_id' => 'nullable|integer',
            'status_pengiriman' => 'nullable|string',
            'status_disposisi' => 'nullable|string',
        ]);

        // Menentukan nomor agenda baru
        $lastAgenda = Surat::latest('no_agenda')->first(); // Ambil surat terakhir berdasarkan no_agenda
        $newNumber = 1; // Nilai default untuk agenda pertama

        if ($lastAgenda) {
            // Ambil angka terakhir dari no_agenda (misalnya AG007 -> 7)
            $lastNumber = (int) substr($lastAgenda->no_agenda, 2); // Mengambil angka setelah 'AG'
            $newNumber = $lastNumber + 1;
        }

        // Format nomor agenda baru, misalnya 'AG007'
        $newAgenda = 'AG' . str_pad($newNumber, 3, '0', STR_PAD_LEFT); // Format menjadi AG007

        // Simpan file dokumen jika ada
        $path = $request->file('dokumen') ? $request->file('dokumen')->store('dokumen_keluar', 'public') : null;

        $user = auth()->user();

        // Simpan data surat dengan no_agenda yang sudah otomatis terisi
        Surat::create([
            'no_agenda' => $newAgenda, // Menggunakan nomor agenda baru
            'tanggal' => $request->tanggal,
            'no_surat' => $request->no_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'perihal' => $request->perihal,
            'konten' => $request->konten,
            'id_sifat_surat' => $request->id_sifat_surat,
            'id_asal_surat' => $request->id_asal_surat,
            'dokumen' => $path,
            'status' => $request->status,
            'pengirim_id' => $user->id, // Menyimpan ID Pengirim
            'pengirim_eksternal' => $request->pengirim_eksternal, // Menyimpan Pengirim Eksternal
            'tujuan_pengguna_id' => $request->tujuan_pengguna_id, // Menyimpan ID Pengguna Tujuan
            'tujuan_instansi_id' => $request->tujuan_instansi_id, // Menyimpan ID Instansi Tujuan
            'status_pengiriman' => $request->status_pengiriman, // Menyimpan Status Pengiriman
            'status_disposisi' => $request->status_disposisi ?? 'Belum Diproses',
        ]);

        return redirect()->route('surat.keluar.index')->with('success', 'Data berhasil disimpan');
    }


    public function keluarupdate(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'no_agenda' => 'required|string',
            'tanggal' => 'required|date',
            'no_surat' => 'required|string|max:255|unique:surat,no_surat',
            'tanggal_surat' => 'required|date',
            'perihal' => 'required|string',
            'konten' => 'required|string',
            'id_sifat_surat' => 'required|integer',
            'id_asal_surat' => 'required|integer',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'status' => 'required|string|in:Masuk,Keluar',
            'pengirim_id' => 'nullable|integer',
            'pengirim_eksternal' => 'nullable|string',
            'tujuan_pengguna_id' => 'nullable|integer',
            'tujuan_instansi_id' => 'nullable|integer',
            'status_pengiriman' => 'nullable|string',
            'status_disposisi' => 'nullable|string',
        ]);


        // Temukan data yang akan diperbarui
        $surat = Surat::findOrFail($id);

      // Simpan data surat
      Surat::create([
        'no_agenda' => $request->no_agenda,
        'tanggal' => $request->tanggal,
        'no_surat' => $request->no_surat,
        'tanggal_surat' => $request->tanggal_surat,
        'perihal' => $request->perihal,
        'konten' => $request->konten,
        'id_sifat_surat' => $request->id_sifat_surat,
        'id_asal_surat' => $request->id_asal_surat,
        'dokumen' => $path,
        'status' => $request->status,
        'pengirim_id' => $request->pengirim_id, // Menyimpan ID Pengirim
        'pengirim_eksternal' => $request->pengirim_eksternal, // Menyimpan Pengirim Eksternal
        'tujuan_pengguna_id' => $request->tujuan_pengguna_id, // Menyimpan ID Pengguna Tujuan
        'tujuan_instansi_id' => $request->tujuan_instansi_id, // Menyimpan ID Instansi Tujuan
        'status_pengiriman' => $request->status_pengiriman, // Menyimpan Status Pengiriman
        'status_disposisi' => $request->status_disposisi, // Menyimpan Status Disposisi
    ]);

        // Periksa jika ada file dokumen baru
        if ($request->hasFile('dokumen')) {
            // Hapus file lama jika ada
            if ($surat->dokumen) {
                Storage::delete($surat->dokumen);
            }

            // Simpan file baru
            $path = $request->file('dokumen')->store('dokumen_keluar', 'public');
            $surat->dokumen = $path;
        }

        // Simpan perubahan ke database
        $surat->save();

        return redirect()->route('surat.keluar.index')->with('success', 'Data berhasil diperbarui');
    }

    public function keluardestroy($id)
    {
        $surat = Surat::findOrFail($id);
        if ($surat->dokumen) {
            Storage::disk('public')->delete($surat->dokumen);
        }
        $surat->delete();
        return redirect()->route('surat.keluar.index');
    }

    public function keluarshow($id)
    {
        // Ambil data surat berdasarkan ID
        $surat = Surat::findOrFail($id);
        $user = Auth::user();

        // Memastikan peran pengguna ada
        if (!$user) {
            return abort(403, 'Pengguna tidak teridentifikasi.');
        }

        // Menyaring akses berdasarkan peran
        if ($user->peran == 'Admin') {
            // Jika Admin, tampilkan semua informasi surat
            return view('crudsurat.detailkeluar', compact('surat'));
        } elseif ($user->peran == 'Sekretariat') {
            // Jika Sekretariat, tampilkan surat
            return view('crudsurat.detailkeluar', compact('surat'));
        } elseif ($user->peran == 'Pimpinan') {
            return view('crudsurat.detailKeluar', compact('surat'));
        } elseif ($user->peran == 'Karyawan') {
            // Jika Karyawan, tampilkan hanya status surat dan instruksi
            return view('crudsurat.detailkeluar_kar', compact('surat'));
        } else {
            // Jika peran tidak teridentifikasi, arahkan ke halaman lain atau tampilkan error
            return abort(403);
        }
    }
    public function kirimKeSekretariat($id)
{
    // Cari surat berdasarkan ID
    $surat = Surat::findOrFail($id);
    // Perbarui status pengiriman surat
    $surat->status_pengiriman = 'Dikirim'; // Mengubah status menjadi 'Dikirim'

    // Simpan perubahan ke database
    $surat->save();

    // Tambahkan logika lain jika diperlukan, seperti mengirim email

    return redirect()->back()->with('success', 'Surat berhasil dikirim ke Sekretariat.');
}
public function disposisi(Request $request, $id)
{
    $surat = Surat::findOrFail($id);  // Ensure surat exists
    // Perform the disposisi logic here
    // Validate and store the disposisi data
    $request->validate([
        'tindakan' => 'required|string',
        'kepada' => 'required|string',
        'keterangan' => 'nullable|string',
    ]);

    // Save the disposisi logic here

    return redirect()->route('surat.index')->with('success', 'Disposisi berhasil dikirim.');
}

    }

