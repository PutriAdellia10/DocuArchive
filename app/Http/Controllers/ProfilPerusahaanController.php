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
        $perusahaan = Perusahaan::first();

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

        // Ambil data perusahaan dari database, atau buat baru jika belum ada
        $perusahaan = Perusahaan::first();
        if (!$perusahaan) {
            $perusahaan = new Perusahaan();
        }

        // Perbarui data perusahaan dengan input baru
        $perusahaan->nama = $request->nama;
        $perusahaan->alamat = $request->alamat;
        $perusahaan->kontak = $request->telepon;
        $perusahaan->email = $request->email;

        // Cek apakah ada file logo yang diunggah
        if ($request->hasFile('logo')) {
            // Simpan file logo dan update path di database
            $path = $request->file('logo')->store('img', 'public');
            $perusahaan->logo = $path;
        }

        // Simpan perubahan ke database
        $perusahaan->save();

        // Redirect ke halaman profil perusahaan dengan pesan sukses
        return redirect()->route('profilperusahaan.index')->with('success', 'Profil perusahaan berhasil diperbarui.');
    }
}
