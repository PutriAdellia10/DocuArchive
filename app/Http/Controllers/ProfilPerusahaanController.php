<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProfilPerusahaanController extends Controller
{
    // Metode index untuk menampilkan profil perusahaan
    public function index()
    {
        // Ambil data dari model Perusahaan
        $perusahaan = Perusahaan::first() ?? new Perusahaan();

        // Kirim data ke view layout.profilperusahaan
        return view('layout.profilperusahaan', compact('perusahaan'));
    }

    // Metode update untuk menyimpan perubahan profil perusahaan
    public function update(Request $request)
{
    // Validasi input
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'telepon' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'logo' => 'nullable|image|max:2048', // Logo opsional
    ]);

    // Ambil data perusahaan dari database
    $perusahaan = Perusahaan::where('nama', $request->nama)->first();

    if (!$perusahaan) {
        // Jika data perusahaan tidak ada, buat baru
        $perusahaan = new Perusahaan();
    }

    // Update data perusahaan
    $perusahaan->nama = $request->nama;
    $perusahaan->alamat = $request->alamat;
    $perusahaan->telepon = $request->telepon;
    $perusahaan->email = $request->email;

    // Jika ada logo, simpan file logo
    if ($request->hasFile('logo')) {
        $perusahaan->logo = $request->file('logo')->store('img', 'public');
    }

    // Simpan perubahan ke database
    $perusahaan->save();

    // Redirect dengan pesan sukses
    return redirect()->route('profilperusahaan.index')->with('success', 'Profil perusahaan berhasil diperbarui.');
}
}
