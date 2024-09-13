<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use Illuminate\Http\Request;

class JenisSuratController extends Controller
{
    // Menampilkan daftar jenis surat
    public function index()
    {
        $jenisSurat = JenisSurat::all();
        return view('layout.jenissurat', compact('jenisSurat'));
    }

    // Menampilkan form untuk menambah jenis surat baru
    public function create()
    {
        return view('jenis_surat.create');
    }

    // Menyimpan jenis surat baru ke database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_jenis' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        JenisSurat::create($validatedData);

        return redirect()->route('jenis_surat.index')->with('success', 'Jenis surat berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit jenis surat
    public function edit($id)
    {
        $jenisSurat = JenisSurat::findOrFail($id);
        return view('jenis_surat.edit', compact('jenisSurat'));
    }

    // Memperbarui jenis surat di database
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_jenis' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
        ]);

        $jenisSurat = JenisSurat::findOrFail($id);
        $jenisSurat->update($validatedData);

        return redirect()->route('jenis_surat.index')->with('success', 'Jenis surat berhasil diperbarui.');
    }

    // Menghapus jenis surat dari database
    public function destroy($id)
    {
        $jenisSurat = JenisSurat::findOrFail($id);
        $jenisSurat->delete();

        return redirect()->route('jenis_surat.index')->with('success', 'Jenis surat berhasil dihapus.');
    }

    // Menampilkan detail jenis surat (opsional)
    public function show($id)
    {
        $jenisSurat = JenisSurat::findOrFail($id);
        return view('jenis_surat.show', compact('jenisSurat'));
    }
}
