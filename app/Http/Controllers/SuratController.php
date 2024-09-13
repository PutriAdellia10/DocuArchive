<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Instansi;
use App\Models\SifatSurat;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SuratController extends Controller
{
    // Surat Masuk Methods

    public function indexMasuk()
    {
        $suratMasuk = Surat::where('status', 'Masuk')->get();
        $instansi = Instansi::all();
        $sifatSurat = SifatSurat::all();
        return view('layout.suratmasuk', compact('suratMasuk', 'instansi', 'sifatSurat'));
    }

    public function create()
    {
        $instansi = Instansi::all();
        $sifatSurat = SifatSurat::all();
        return view('suratmasuk.create', compact('instansi', 'sifatSurat'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
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
        ]);

        $surat = new Surat($validatedData);

        if ($request->hasFile('dokumen')) {
            $filePath = $request->file('dokumen')->store('dokumen_masuk', 'public');
            $surat->dokumen = $filePath;
        }

        $surat->save();

        return redirect()->route('surat.index');
    }

    public function edit($id)
    {
        $surat = Surat::findOrFail($id);
        $instansi = Instansi::all();
        $sifatSurat = SifatSurat::all();
        return view('crudsurat.editmasuk', compact('surat', 'instansi', 'sifatSurat'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
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
        ]);

        $surat = Surat::findOrFail($id);

        if ($request->hasFile('dokumen')) {
            if ($surat->dokumen) {
                Storage::disk('public')->delete($surat->dokumen);
            }
            $filePath = $request->file('dokumen')->store('dokumen_masuk', 'public');
            $surat->dokumen = $filePath;
        }

        $surat->update($validatedData);

        return redirect()->route('surat.index');
    }

    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        if ($surat->dokumen) {
            Storage::disk('public')->delete($surat->dokumen);
        }
        $surat->delete();
        return redirect()->route('surat.index');
    }

    public function show($id)
    {
        $surat = Surat::findOrFail($id);
        return view('crudsurat.detailmasuk', compact('surat'));
    }

    // Surat Keluar Methods

    public function indexKeluar()
    {
        $suratKeluar = Surat::where('status', 'Keluar')->get();
        $instansi = Instansi::all();
        $sifatSurat = SifatSurat::all();
        return view('layout.suratkeluar', compact('suratKeluar', 'instansi', 'sifatSurat'));
    }

    public function keluarcreate()
    {
        $instansi = Instansi::all();
        $sifatSurat = SifatSurat::all();
        return view('suratkeluar.create', compact('instansi', 'sifatSurat'));
    }

    public function keluarstore(Request $request)
    {
        // Validasi input
        $request->validate([
            'no_agenda' => 'required',
            'tanggal' => 'required|date',
            'id_asal_surat' => 'required|exists:instansi,id',
            'no_surat' => 'required|unique:surat,no_surat',
            'tanggal_surat' => 'required|date',
            'perihal' => 'required',
            'konten' => 'nullable',
            'id_sifat_surat' => 'required|exists:sifat_surat,id',
            'status' => 'required',
            'dokumen' => 'required|mimes:pdf|max:10000',
        ]);

        // Simpan file dokumen
        $path = $request->file('dokumen')->store('dokumen_keluar', 'public');

        // Simpan data surat
        Surat::create([
            'no_agenda' => $request->no_agenda,
            'tanggal' => $request->tanggal,
            'id_asal_surat' => $request->id_asal_surat,
            'no_surat' => $request->no_surat,
            'tanggal_surat' => $request->tanggal_surat,
            'perihal' => $request->perihal,
            'konten' => $request->konten,
            'id_sifat_surat' => $request->id_sifat_surat,
            'status' => $request->status,
            'dokumen' => $path,
        ]);

        return redirect()->route('surat.keluar.index')->with('success', 'Data berhasil disimpan');
    }

    public function keluarupdate(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'no_agenda' => 'required',
            'tanggal' => 'required|date',
            'id_asal_surat' => 'required|exists:instansi,id',
            'no_surat' => 'required|unique:surat,no_surat,' . $id,
            'tanggal_surat' => 'required|date',
            'perihal' => 'required',
            'konten' => 'nullable',
            'id_sifat_surat' => 'required|exists:sifat_surat,id',
            'status' => 'required',
            'dokumen' => 'nullable|mimes:pdf|max:10000',
        ]);

        // Temukan data yang akan diperbarui
        $surat = Surat::findOrFail($id);

        // Perbarui data
        $surat->no_agenda = $request->no_agenda;
        $surat->tanggal = $request->tanggal;
        $surat->id_asal_surat = $request->id_asal_surat;
        $surat->no_surat = $request->no_surat;
        $surat->tanggal_surat = $request->tanggal_surat;
        $surat->perihal = $request->perihal;
        $surat->konten = $request->konten;
        $surat->id_sifat_surat = $request->id_sifat_surat;
        $surat->status = $request->status;

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

    public function keluaredit($id)
    {
        $surat = Surat::findOrFail($id);
        $instansi = Instansi::all();
        $sifatSurat = SifatSurat::all();
        return view('suratkeluar.edit', compact('surat', 'instansi', 'sifatSurat'));
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
        $surat = Surat::findOrFail($id);
        return view('crudsurat.detailkeluar', compact('surat'));
    }

}
