<?php

namespace App\Http\Controllers;

use App\Models\Disposisi;
use App\Models\Surat;
use App\Models\Pengguna;
use App\Models\User;
use App\Notifications\DisposisiNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\support\Facades\Session;
use Illuminate\Notifications\Notification;


class DisposisiController extends Controller
{
    // Menampilkan daftar disposisi
    public function index()
    {
        $disposisi = Surat::all(); // Ambil semua surat sebagai contoh
        return view('disposisi.index', compact('disposisi'));
    }

    // Menampilkan detail disposisi
    public function show($id)
    {
        $surat = Surat::findOrFail($id);
        return view('layout.disposisi', compact('surat'));
    }

    // Menampilkan form untuk membuat disposisi baru
    public function create()
    {
        return view('disposisi.create');
    }

    // Menyimpan disposisi baru
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'tindakan' => 'array|required',
            'kepada' => 'required|string',
            'keterangan' => 'required|string',
        ]);

        // Simpan data disposisi ke database atau proses sesuai kebutuhan
        // Misalnya, simpan ke tabel notifikasi
        // Notification::create([...]);

        // Menyimpan notifikasi ke session
        Session::flash('success', 'Data disposisi berhasil dikirim.');

        return redirect()->route('surat.index'); // Ubah sesuai dengan rute tujuan
    }

    // Menghapus disposisi
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();
        return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil dihapus.');
    }
}
