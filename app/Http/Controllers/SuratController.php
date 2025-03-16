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

    if ($user->peran == 'Karyawan') {
        $suratMasuk = Surat::where('status', 'Masuk')
            ->whereIn('status_disposisi', ['Diproses', 'Selesai'])
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan waktu pembuatan
            ->get();

        $suratKeluar = Surat::where('status', 'Keluar')
            ->whereIn('status_disposisi', ['Diproses', 'Selesai'])
            ->whereDoesntHave('pengirim', function ($query) {
                $query->where('peran', 'Karyawan');
            })
            ->orderBy('created_at', 'desc') // Urutkan berdasarkan waktu pembuatan
            ->get();

        $suratGabungan = $suratMasuk->merge($suratKeluar)->sortByDesc('created_at'); // Gabungkan dan urutkan
        return view('surat.masuk_kar', compact('suratGabungan', 'instansi', 'sifatSurat', 'pengguna'));
    } elseif ($user->peran == 'Pimpinan') {
        $suratMasuk = Surat::where('status', 'Masuk')
            ->whereIn('status_disposisi', ['Diproses', 'Selesai'])
            ->orderBy('created_at', 'desc')
            ->get();

        $suratKeluar = Surat::where('status', 'Keluar')
        ->whereIn('status_disposisi', ['Diproses', 'Selesai'])
            ->whereNotIn('pengirim_id', function ($query) {
                $query->select('id')
                    ->from('pengguna')
                    ->whereIn('peran', ['Sekretariat', 'Admin']);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $suratGabungan = $suratMasuk->merge($suratKeluar)->sortByDesc('created_at');
        return view('surat.masuk', compact('suratGabungan', 'instansi', 'sifatSurat', 'pengguna'));
    } elseif ($user->peran == 'Sekretariat') {
        $suratMasuk = Surat::where('status', 'Masuk')
            ->orderBy('created_at', 'desc')
            ->get();

        $suratKeluar = Surat::where('status', 'Keluar')
            ->whereNotIn('pengirim_id', function ($query) {
                $query->select('id')
                    ->from('pengguna')
                    ->whereIn('peran', ['Sekretariat', 'Admin']);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $suratGabungan = $suratMasuk->merge($suratKeluar)->sortByDesc('created_at');
        return view('surat.masuk', compact('suratGabungan', 'instansi', 'sifatSurat', 'pengguna'));
    } elseif ($user->peran == 'Admin') {
        $suratMasuk = Surat::where('status', 'Masuk')
            ->orderBy('created_at', 'desc')
            ->get();

        $suratKeluar = Surat::where('status', 'Keluar')
            ->whereNotIn('pengirim_id', function ($query) {
                $query->select('id')
                    ->from('pengguna')
                    ->whereIn('peran', ['Sekretariat', 'Admin']);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $suratGabungan = $suratMasuk->merge($suratKeluar)->sortByDesc('created_at');
        return view('surat.masuk', compact('suratGabungan', 'instansi', 'sifatSurat', 'pengguna'));
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
            'id_asal_surat' => 'nullable|integer',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:51200',
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
            'tanggal' => 'required|date',
            'no_surat' => 'required|string|max:255|unique:surat,no_surat,' . $id,
            'tanggal_surat' => 'required|date',
            'perihal' => 'required|string',
            'konten' => 'required|string',
            'id_sifat_surat' => 'nullable|integer',
            'id_asal_surat' => 'nullable|integer',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:51200', // Allow up to 50 MB
            'status' => 'nullable|string|in:Masuk,Keluar',
            'pengirim_eksternal' => 'nullable|string',
            'tujuan_pengguna_id' => 'nullable|integer',
            'tujuan_instansi_id' => 'nullable|integer',
            'status_pengiriman' => 'nullable|string',
            'status_disposisi' => 'nullable|string',
        ]);

        // Temukan data yang akan diperbarui
        $surat = Surat::findOrFail($id);

        // Set $path to current dokumen if no new file is uploaded
        $path = $surat->dokumen;

        // Periksa jika ada file dokumen baru
        if ($request->hasFile('dokumen')) {
            $dokumen = $request->file('dokumen');
            // Mengganti dokumen yang baru diupload
            $path = $dokumen->storeAs('dokumen_masuk', $dokumen->getClientOriginalName(), 'public');
        }

        // Update data surat lainnya
        $surat->update([
            'tanggal' => $request->tanggal,
            'no_surat' => $request->no_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'perihal' => $request->perihal,
            'konten' => $request->konten,
            'id_asal_surat' => $request->id_asal_surat,
            'dokumen' => $path, // Pastikan dokumen selalu diperbarui dengan path yang benar
            'status' => $request->status ?? 'Masuk',
            'pengirim_eksternal' => $request->pengirim_eksternal, // Menyimpan Pengirim Eksternal
            'tujuan_pengguna_id' => $request->tujuan_pengguna_id, // Menyimpan ID Pengguna Tujuan
            'tujuan_instansi_id' => $request->tujuan_instansi_id, // Menyimpan ID Instansi Tujuan
        ]);

        return redirect()->route('surat.index')->with('success', 'Surat Keluar berhasil diperbarui.');
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
        $pengguna = User::all(); // Get all pengguna from the database
        $instansi = Instansi::all(); // Get all instansi from the database
        // Memastikan peran pengguna ada
        if (!$user) {
            return abort(403, 'Pengguna tidak teridentifikasi.');
        }

        // Menyaring akses berdasarkan peran
        if ($user->peran == 'Admin') {
            // Jika Admin, tampilkan semua informasi surat
            return view('crudsurat.detailmasuk', compact('surat','pengguna','instansi'));
        } elseif ($user->peran == 'Sekretariat') {
            // Jika Sekretariat, tampilkan surat
            return view('crudsurat.detailmasuk', compact('surat','pengguna','instansi'));
        } elseif ($user->peran == 'Pimpinan') {
            return view('crudsurat.detailmasuk', compact('surat','pengguna','instansi'));
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
        $pengguna = User::where('peran', 'Karyawan')->get();

        // Cek peran pengguna dan ambil surat keluar yang sesuai
        if ($user->peran == 'Karyawan') {
            $suratKeluar = Surat::where('status', 'Keluar')
                ->whereIn('status_pengiriman', ['Draft', 'Dikirim', 'Diterima'])
                ->orderBy('created_at', 'desc') // Urutkan berdasarkan waktu terbaru
                ->get();

            return view('surat.keluar_kar', compact('suratKeluar', 'instansi', 'sifatSurat')); // View untuk Karyawan
        } elseif ($user->peran == 'Pimpinan') {
            $suratKeluar = Surat::where('status', 'Keluar')
                ->whereIn('status_disposisi', ['Diproses', 'Selesai'])
                ->whereNotIn('pengirim_id', function ($query) {
                    $query->select('id')
                        ->from('pengguna')
                        ->where('peran', 'Karyawan');
                })
                ->orderBy('created_at', 'desc') // Urutkan berdasarkan waktu terbaru
                ->get();

            return view('surat.keluar', compact('suratKeluar', 'instansi', 'sifatSurat', 'pengguna'));
        } elseif ($user->peran == 'Sekretariat') {
            $suratKeluar = Surat::where('status', 'Keluar')
                ->whereIn('status_disposisi', ['Belum Diproses', 'Diproses', 'Selesai'])
                ->whereNotIn('pengirim_id', function ($query) {
                    $query->select('id')
                        ->from('pengguna')
                        ->where('peran', 'Karyawan');
                })
                ->orderBy('created_at', 'desc') // Urutkan berdasarkan waktu terbaru
                ->get();

            return view('surat.keluar', compact('suratKeluar', 'instansi', 'sifatSurat', 'pengguna')); // View untuk Sekretariat
        } elseif ($user->peran == 'Admin') {
            $suratKeluar = Surat::where('status', 'Keluar')
                ->whereNotIn('pengirim_id', function ($query) {
                    $query->select('id')
                        ->from('pengguna')
                        ->where('peran', 'Karyawan');
                })
                ->orderBy('created_at', 'desc') // Urutkan berdasarkan waktu terbaru
                ->get();

            return view('surat.keluar', compact('suratKeluar', 'instansi', 'sifatSurat', 'pengguna')); // View untuk Admin
        } else {
            return abort(403); // Akses ditolak jika peran tidak dikenali
        }
    }
    public function keluaredit($id)
{
    $surat = Surat::findOrFail($id);
    $pengguna = User::all(); // or other related data
    $instansi = Instansi::all(); // or other related data

    return view('your.view.name', compact('surat', 'pengguna', 'instansi'));
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
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:51200', // Allow up to 50 MB
            'status' => 'required|string|in:Masuk,Keluar',
            'pengirim_id' => 'nullable|integer',
            'pengirim_eksternal' => 'nullable|string',
            'tujuan_pengguna_id' => 'nullable|integer',
            'tujuan_instansi_id' => 'nullable|integer',
            'status_pengiriman' => 'nullable|string',
            'status_disposisi' => 'nullable|string',
        ]);

        // Menentukan nomor agenda baru
        $lastSurat = Surat::where('no_agenda', 'like', 'AG%')->orderBy('no_agenda', 'desc')->first();
        if ($lastSurat) {
            $lastNumber = (int) substr($lastSurat->no_agenda, 2);
            $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '001';
        }
        $noAgenda = 'AG' . $nextNumber;

        $path = null; // Default value if no file is uploaded
        if ($request->hasFile('dokumen')) {
            $path = $request->file('dokumen')->store('dokumen_keluar', 'public');
        }

        $user = auth()->user();

        // Simpan data surat dengan no_agenda yang sudah otomatis terisi
        Surat::create([
            'no_agenda' => $noAgenda, // Menggunakan nomor agenda baru
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

        return redirect()->route('surat.keluar.index')->with('success', 'Surat berhasil ditambahkan.');
    }

    public function keluarupdate(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'tanggal' => 'nullable|date',
            'no_surat' => 'nullable|string|max:255|unique:surat,no_surat,' . $id,
            'tanggal_surat' => 'nullable|date',
            'perihal' => 'required|string',
            'konten' => 'required|string',
            'id_sifat_surat' => 'nullable|integer',
            'id_asal_surat' => 'nullable|integer',
            'dokumen' => 'nullable|file|mimes:pdf,doc,docx|max:51200', // Allow up to 50 MB
            'status' => 'nullable|string|in:Masuk,Keluar',
            'pengirim_eksternal' => 'nullable|string',
            'tujuan_pengguna_id' => 'nullable|integer',
            'tujuan_instansi_id' => 'nullable|integer',
            'status_pengiriman' => 'nullable|string',
            'status_disposisi' => 'nullable|string',
        ]);

        // Temukan data yang akan diperbarui
        $surat = Surat::findOrFail($id);
        // Ambil nilai lama jika tidak ada nilai baru yang diisi
        $tanggal = $request->tanggal ?? $surat->tanggal;
        $no_surat = $request->no_surat ?? $surat->no_surat;
        $tanggal_surat = $request->tanggal_surat ?? $surat->tanggal_surat;
        // Set $path to current dokumen if no new file is uploaded
        $path = $surat->dokumen;

        if ($request->hasFile('dokumen')) {
            $dokumen = $request->file('dokumen');
            $path = $dokumen->storeAs('dokumen_keluar', $dokumen->getClientOriginalName(), 'public');
        }

        // Update data surat lainnya
        $surat->update([
            'tanggal' => $tanggal,
            'no_surat' => $no_surat,
            'tanggal_surat' => $tanggal_surat,
            'perihal' => $request->perihal,
            'konten' => $request->konten,
            'id_asal_surat' => $request->id_asal_surat,
            'dokumen' => $path, // Pastikan dokumen selalu diperbarui dengan path yang benar
            'status' => $request->status ?? 'Keluar',
            'pengirim_eksternal' => $request->pengirim_eksternal, // Menyimpan Pengirim Eksternal
            'tujuan_pengguna_id' => $request->tujuan_pengguna_id, // Menyimpan ID Pengguna Tujuan
            'tujuan_instansi_id' => $request->tujuan_instansi_id, // Menyimpan ID Instansi Tujuan
        ]);

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('surat.keluar.index')->with('success', 'Surat Keluar berhasil diperbarui.');
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
        $pengguna = User::all(); // Get all pengguna from the database
        $instansi = Instansi::all(); // Get all instansi from the database

        // Memastikan peran pengguna ada
        if (!$user) {
            return abort(403, 'Pengguna tidak teridentifikasi.');
        }

        // Menyaring akses berdasarkan peran
        if ($user->peran == 'Admin') {
            // Jika Admin, tampilkan semua informasi surat
            return view('crudsurat.detailkeluar', compact('surat','pengguna','instansi'));
        } elseif ($user->peran == 'Sekretariat') {
            // Jika Sekretariat, tampilkan surat
            return view('crudsurat.detailkeluar', compact('surat','pengguna','instansi'));
        } elseif ($user->peran == 'Pimpinan') {
            return view('crudsurat.detailKeluar', compact('surat','pengguna','instansi'));
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

        // Perbarui status pengiriman surat jika status pengiriman masih Draft
        if ($surat->status_pengiriman == 'Draft') {
            $surat->status_pengiriman = 'Dikirim';

            if ($surat->status_pengiriman == 'Dikirim' && in_array($surat->status_disposisi, ['Diproses', 'Selesai'])) {
                $surat->status_pengiriman = 'Diterima';
                $surat->save();
                \Log::info('Surat status pengiriman diperbarui', ['id' => $surat->id, 'status_pengiriman' => $surat->status_pengiriman]);
            }

            // Simpan perubahan ke database
            $surat->save();

            // Redirect kembali dengan pesan sukses
            return redirect()->back()->with('success', 'Surat berhasil dikirim ke Sekretariat.');
        }

        // Jika status pengiriman sudah bukan Draft, tidak perlu diproses lagi
        return redirect()->back()->with('warning', 'Surat sudah dikirim sebelumnya.');
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
public function updateDisposisi(Request $request, $id)
{
    // Validasi input status disposisi
    $request->validate([
        'status_disposisi' => 'required|string|in:Belum Diproses,Diproses,Selesai',
    ]);

    // Ambil surat berdasarkan ID
    $surat = Surat::findOrFail($id);

    // Perbarui status disposisi
    $surat->status_disposisi = $request->status_disposisi;

    // Jika status disposisi berubah menjadi 'Diproses' atau 'Selesai', ubah status pengiriman
    if (in_array($request->status_disposisi, ['Diproses', 'Selesai'])) {
        $surat->status_pengiriman = 'Diterima';
    }

    // Simpan perubahan
    $surat->save();

    return redirect()->back()->with('success', 'Status disposisi dan pengiriman berhasil diperbarui.');
}
public function updateStatus(Request $request, $id)
{
    // Temukan surat berdasarkan ID
    $surat = Surat::findOrFail($id);

    // Perbarui status disposisi berdasarkan keterangan dan lampiran
    $status = $request->input('status_disposisi');
    $surat->status_disposisi = $status;

    // Simpan perubahan
    $surat->save();

    return response()->json(['success' => true]);
}
    }

