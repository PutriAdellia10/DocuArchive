<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\Surat;
use App\Models\Pengguna;
use Illuminate\Http\Request;

class DisposisiController extends Controller
{
    // Menampilkan daftar disposisi
    public function index()
    {
        $disposisi = Disposisi::with('surat', 'pengguna')->get();
        return view('disposisi.index', compact('disposisi'));
    }

    // Menampilkan form untuk menambah disposisi baru
    public function create()
    {
        $surat = Surat::all();
        $pengguna = Pengguna::all();
        return view('disposisi.create', compact('surat', 'pengguna'));
    }

    // Menyimpan disposisi baru ke database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_surat' => 'required|exists:surat,id',
            'id_pengguna' => 'required|exists:pengguna,id',
            'instruksi' => 'required|string',
            'status' => 'required|in:Belum Diproses,Diproses,Selesai',
        ]);

        Disposisi::create($validatedData);

        return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit disposisi
    public function edit($id)
    {
        $disposisi = Disposisi::findOrFail($id);
        $surat = Surat::all();
        $pengguna = Pengguna::all();
        return view('disposisi.edit', compact('disposisi', 'surat', 'pengguna'));
    }

    // Memperbarui disposisi di database
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'id_surat' => 'required|exists:surat,id',
            'id_pengguna' => 'required|exists:pengguna,id',
            'instruksi' => 'required|string',
            'status' => 'required|in:Belum Diproses,Diproses,Selesai',
        ]);

        $disposisi = Disposisi::findOrFail($id);
        $disposisi->update($validatedData);

        return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil diperbarui.');
    }

    // Menghapus disposisi dari database
    public function destroy($id)
    {
        $disposisi = Disposisi::findOrFail($id);
        $disposisi->delete();

        return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil dihapus.');
    }

    // Menampilkan detail disposisi (opsional)
    public function show($id)
    {
        $disposisi = Disposisi::with('surat', 'pengguna')->findOrFail($id);
        return view('disposisi.show', compact('disposisi'));
    }
}
