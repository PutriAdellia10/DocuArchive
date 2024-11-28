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
            'kepada' => 'required|string',
            'lampiran' => 'nullable|string',
            'catatan' => 'nullable|string', // If only Pimpinan can add catatan
        ]);

        Disposisi::create([
            'surat_id' => $id,
            'keterangan' => $request->keterangan,
            'kepada' => $request->kepada,
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
        'kepada' => 'required|string|max:255',
        'keterangan' => 'nullable|string',
        'lampiran' => 'nullable|string',
        'catatan' => 'nullable|string', // If only Pimpinan can add catatan
    ]);

    $disposisi = Disposisi::findOrFail($id);
    $disposisi->update([
        'kepada' => $request->kepada,
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
    public function submitDisposition(Request $request, $id)
{
    $surat = Surat::findOrFail($id);

    // Update status disposisi menjadi 'Diproses' jika surat belum diproses
    if ($surat->status_disposisi != 'Selesai') {
        $surat->status_disposisi = 'Diproses';
    }

    $request->validate([
        'keterangan' => 'nullable|string',
        'kepada' => 'nullable|string',
        'lampiran' => 'nullable|string',
        'catatan' => 'nullable|string', // Catatan hanya diisi oleh pimpinan
    ]);

    // Menyimpan disposisi baru
    Disposisi::create([
        'surat_id' => $id,
        'keterangan' => $request->keterangan,
        'kepada' => $request->kepada,
        'lampiran' => $request->lampiran,
        'catatan' => $request->catatan,
    ]);

    // Periksa apakah catatan sudah diisi dan ubah status menjadi 'Selesai'
    if ($request->has('catatan') && !empty($request->catatan)) {
        $surat->status_disposisi = 'Selesai';  // Set status menjadi 'Selesai' jika catatan sudah ada
    }

    $surat->save();  // Simpan perubahan pada surat

    return redirect()->back()->with('success', 'Disposisi berhasil dikirim dan status diubah.');
}



}
