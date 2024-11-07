<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InstansiController extends Controller
{

    public function index(Request $request)
    {

        $instansi = Instansi::paginate(10); // Mengambil data dengan paginasi
    return view('layout.instansi', compact('instansi'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_instansi' => 'required|string|max:255',
        'kontak' => 'required|string|max:255',
        'jenis_kerja_sama' => 'required|string|max:255',
    ]);

    try {
        Instansi::create([
            'nama_instansi' => $request->nama_instansi,
            'kontak' => $request->kontak,
            'jenis_kerja_sama' => $request->jenis_kerja_sama,
        ]);

        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil ditambahkan');
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return back()->withErrors(['error' => 'Gagal menambahkan instansi']);
    }
}

public function edit($id)
{
    $instansi = Instansi::find($id);
    if (!$instansi) {
        return redirect()->back()->withErrors(['Instansi tidak ditemukan.']);
    }
    return view('layout.edit_instansi', compact('instansi'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_instansi' => 'required|string|max:255',
        'kontak' => 'required|string|max:255',
        'jenis_kerja_sama' => 'required|string|max:255',
    ]);

    try {
        $instansi = Instansi::findOrFail($id);
        $instansi->update([
            'nama_instansi' => $request->nama_instansi,
            'kontak' => $request->kontak,
            'jenis_kerja_sama' => $request->jenis_kerja_sama,
        ]);

        return redirect()->route('instansi.index')->with('success', 'Instansi berhasil diperbarui');
    } catch (\Exception $e) {
        Log::error($e->getMessage());
        return back()->withErrors(['error' => 'Gagal memperbarui instansi']);
    }
}


public function destroy($id)
{
    $instansi = Instansi::findOrFail($id); // Cari instansi berdasarkan id
    $instansi->delete(); // Hapus instansi dari database

    return response()->json(['message' => 'Instansi berhasil dihapus'], 200);
}

public function cariInstansi(Request $request)
{
    $keyword = $request->get('keyword');
    $instansi = Instansi::where('nama_instansi', 'like', '%' . $keyword . '%')
        ->orWhere('kontak', 'like', '%' . $keyword . '%')
        ->orWhere('jenis_kerja_sama', 'like', '%' . $keyword . '%')
        ->get();

    return response()->json($instansi);
}

}
