<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\Surat;
use App\Models\Pengguna;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DisposisiController extends Controller
{
    // Method untuk menampilkan daftar disposisi
    public function disposisi(Request $request) // Tambahkan Request sebagai parameter
    {
        // Ambil semua data disposisi dari database
        $query = Disposisi::query();

        // Cek jika ada parameter pencarian
        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');
            $query->where('surat', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('pengguna', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('instruksi', 'LIKE', "%{$searchTerm}%");
        }

        // Ambil data disposisi berdasarkan query
        $disposisi = $query->paginate(5);

        // Kembalikan view dengan data disposisi
        return view('layout.disposisi', compact('disposisi'));
    }

    public function store(Request $request)
{
    Log::info($request->all()); // Ini untuk mengecek data yang diterima

    // Validasi data input
    $request->validate([
        'surat' => 'required',
        'pengguna' => 'required',
        'instruksi' => 'required',
        'status' => 'required',
        'dibuat_pada' => 'required|date',
    ]);

    // Tambahkan data disposisi ke dalam database
    Disposisi::create([
        'surat' => $request->surat,
        'pengguna' => $request->pengguna,
        'instruksi' => $request->instruksi,
        'status' => $request->status,
        'dibuat_pada' => $request->dibuat_pada,
    ]);

    Log::info("Disposisi berhasil ditambahkan"); // Log setelah data berhasil disimpan

    // Redirect ke halaman daftar disposisi dengan pesan sukses
    return redirect()->route('disposisi')->with('success', 'Disposisi berhasil ditambahkan');
}

public function edit($id)
{
    $disposisi = Disposisi::find($id);
    return response()->json($disposisi); // Mengembalikan data disposisi untuk diisi di modal
}

public function update(Request $request, $id)
{
    $request->validate([
        'surat' => 'required',
        'pengguna' => 'required',
        'instruksi' => 'required',
        'status' => 'required',
        'dibuat_pada' => 'required|date',
    ]);

    $disposisi = Disposisi::find($id);
    $disposisi->update($request->all());

    return redirect()->route('disposisi')->with('success', 'Disposisi berhasil diperbarui.');
}

public function destroy($id)
{
    $disposisi = Disposisi::find($id);
    $disposisi->delete();

    return redirect()->route('disposisi')->with('success', 'Disposisi berhasil dihapus.');
}
}
