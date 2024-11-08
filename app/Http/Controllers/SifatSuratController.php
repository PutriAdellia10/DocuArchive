<?php

namespace App\Http\Controllers;

use App\Models\SifatSurat;
use Illuminate\Http\Request;

class SifatSuratController extends Controller
{
    // Menampilkan daftar sifat surat
    public function index(Request $request)
    {
        $query = SifatSurat::query();

        if ($request->has('search')) {
            $query->where('nama_sifat', 'LIKE', '%' . $request->search . '%');
        }

        $sifatSurat = $query->paginate(10);
        return view('layout.sifatsurat', compact('sifatSurat'));
    }


    // Menampilkan form untuk menambah sifat surat baru
    public function create()
    {
        return view('sifat_surat.create');
    }

    // Menyimpan sifat surat baru ke database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_sifat' => 'required|string|max:50',
            'deskripsi' => 'nullable|string',
        ]);

        SifatSurat::create($validatedData);

        return redirect()->route('sifat_surat.index')->with('success', 'Sifat surat berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit sifat surat
    public function edit($id)
    {
        $sifatSurat = SifatSurat::findOrFail($id);
        return view('sifat_surat.edit', compact('sifatSurat'));
    }

    // Memperbarui sifat surat di database
    public function update(Request $request, $id)
{
    $sifatSurat = SifatSurat::findOrFail($id);

    $validatedData = $request->validate([
        'nama_sifat' => 'required|string|max:50',
        'deskripsi' => 'nullable|string',
    ]);

    $sifatSurat->update($validatedData);

    return redirect()->route('sifat_surat.index')->with('success', 'Sifat surat berhasil diperbarui.');
}

public function destroy($id)
{
    $sifatSurat = SifatSurat::findOrFail($id);
    $sifatSurat->delete();

    return redirect()->route('sifat_surat.index')->with('success', 'Sifat surat berhasil dihapus.');
}

    // Menampilkan detail sifat surat (opsional)
    public function show($id)
{
    $sifatSurat = SifatSurat::find($id);

    if (!$sifatSurat) {
        return redirect()->route('sifat_surat.index')->with('error', 'Sifat surat tidak ditemukan.');
    }

    return view('layout.sifatsurat', compact('sifatSurat'));
}

}
