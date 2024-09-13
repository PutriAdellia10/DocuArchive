<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    // Menampilkan daftar instansi
    public function index()
    {
        $instansi = Instansi::all();
        return view('instansi.index', compact('instansi'));
    }

    // Menampilkan formulir untuk menambahkan instansi baru
    public function create()
    {
        return view('instansi.create');
    }

    // Menyimpan instansi baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:100',
            'kontak' => 'nullable|string|max:100',
            'jenis_kerja_sama' => 'nullable|string',
        ]);

        Instansi::create($request->all());

        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil ditambahkan.');
    }

    // Menampilkan formulir untuk mengedit instansi yang ada
    public function edit(Instansi $instansi)
    {
        return view('instansi.edit', compact('instansi'));
    }

    // Memperbarui instansi yang ada di database
    public function update(Request $request, Instansi $instansi)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:100',
            'kontak' => 'nullable|string|max:100',
            'jenis_kerja_sama' => 'nullable|string',
        ]);

        $instansi->update($request->all());

        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil diperbarui.');
    }

    // Menghapus instansi dari database
    public function destroy(Instansi $instansi)
    {
        $instansi->delete();

        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil dihapus.');
    }
}
