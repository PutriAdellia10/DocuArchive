<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\Surat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DisposisiController extends Controller
{
    // Menampilkan daftar disposisi
    public function index()
    {
        $disposisiEntries = Disposisi::all();
        $surat = Surat::whereIn('status_disposisi', [ 'Diproses','Selesai'])->get();
        return view('layout.disposisi', compact('disposisiEntries', 'surat'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'nullable|string',
            'lampiran' => 'nullable|string',
            'catatan' => 'nullable|string', // Catatan hanya diisi oleh pimpinan
        ]);

        Disposisi::create([
            'surat_id' => $id,
            'keterangan' => $request->keterangan,
            'lampiran' => $request->lampiran,
            'catatan' => $request->catatan,
        ]);

        return redirect()->back()->with('success', 'Disposisi berhasil dikirim.');
    }

// Menampilkan detail disposisi berdasarkan surat_id
public function show($id)
{
    $surat = Surat::findOrFail($id);
    $disposisiEntries = Disposisi::where('surat_id', $id)->get();

    return view('layout.disposisi', compact('surat', 'disposisiEntries'));
}

// Mengedit data disposisi
public function edit($id)
{
    $disposisi = Disposisi::findOrFail($id);
    $statusOptions = ['Belum Diproses', 'Diproses', 'Selesai'];

    return view('disposisi.edit', compact('disposisi', 'statusOptions'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'keterangan' => 'nullable|string',
        'lampiran' => 'nullable|string',
        'catatan' => 'nullable|string', // Catatan hanya diisi oleh pimpinan
    ]);

    $disposisi = Disposisi::findOrFail($id);
    $disposisi->update([
        'keterangan' => $request->keterangan,
        'lampiran' => $request->lampiran,
        'catatan' => $request->catatan,
    ]);

    return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil diperbarui.');
}

    // Menghapus data disposisi
    public function destroy($id)
    {
        $disposisi = Disposisi::findOrFail($id);
        $disposisi->delete();

        return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil dihapus.');
    }

    // Mengirim disposisi untuk status 'Diproses'
    public function submitDisposition(Request $request, $suratId)
{
    // Mencari surat yang sesuai dengan ID
    $surat = Surat::findOrFail($suratId);

    // Update status disposisi menjadi 'Diproses' jika surat belum diproses
    if ($surat->status_disposisi != 'Selesai') {
        $surat->status_disposisi = 'Diproses';
    }

    // Validasi input dari form
    $request->validate([
        'keterangan' => 'nullable|string',  // Keterangan oleh Sekretariat
        'lampiran' => 'nullable|string',    // Lampiran yang relevan
        'catatan' => 'nullable|string',     // Catatan hanya diisi oleh Pimpinan
    ]);

    // Jika disposisi sudah ada, ambil data disposisi sebelumnya, jika belum ada, buat yang baru
    $disposisi = Disposisi::where('surat_id', $suratId)->first();

    // Jika belum ada disposisi, buat disposisi baru
    if (!$disposisi) {
        $disposisi = new Disposisi;
        $disposisi->surat_id = $suratId;
    }

    // Simpan keterangan, kepada, dan lampiran oleh Sekretariat
    if (auth()->user()->peran != 'Pimpinan') {
        $disposisi->keterangan = $request->keterangan;
        $disposisi->lampiran = $request->lampiran;
    }

    // Simpan catatan oleh Pimpinan
    if (auth()->user()->peran == 'Pimpinan' && $request->has('catatan')) {
        $disposisi->catatan = $request->catatan;
        // Periksa apakah catatan sudah diisi dan ubah status menjadi 'Selesai'
        $surat->status_disposisi = 'Selesai';
    }

    // Simpan perubahan pada disposisi
    $disposisi->save();

    // Simpan perubahan status pada surat jika diperlukan
    $surat->save();

    // Menyimpan pesan sukses dalam session flash
    return redirect()->route('disposisi.show', $suratId)
                     ->with('success', 'Disposisi berhasil dikirim dan status diubah.');
}
}
