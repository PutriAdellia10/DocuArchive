<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    // Menampilkan halaman notifikasi
    public function index()
    {
        // Mendapatkan notifikasi yang belum dibaca untuk pengguna saat ini
        $notifications = Notifikasi::where('id_pengguna', Auth::id())
                                   ->whereNull('sudah_dibaca') // Menampilkan notifikasi yang belum dibaca
                                   ->orderBy('dibuat_pada', 'desc')
                                   ->get();

        // Mengirim notifikasi ke tampilan
        return view('layout.notifikasi', compact('notifications'));
    }

    // Menandai notifikasi sebagai sudah dibaca
    public function markAsRead($id)
    {
        // Menemukan notifikasi berdasarkan ID
        $notification = Notifikasi::where('id_pengguna', Auth::id())
                                  ->where('id', $id)
                                  ->first();

        // Jika notifikasi ditemukan, tandai sebagai sudah dibaca
        if ($notification) {
            $notification->sudah_dibaca = now(); // Update kolom sudah_dibaca
            $notification->save();
        }

        // Arahkan kembali ke halaman notifikasi
        return redirect()->route('notifikasi.index');
    }

    // Menampilkan detail disposisi dari notifikasi
    public function showDisposisi($id)
    {
        // Menemukan notifikasi berdasarkan ID
        $notification = Notifikasi::where('id_pengguna', Auth::id())
                                  ->where('id', $id)
                                  ->first();

        // Pastikan notifikasi ditemukan
        if ($notification) {
            // Arahkan ke halaman detail disposisi berdasarkan ID disposisi
            return redirect()->route('disposisi.show', $notification->data['disposisi_id']);
        }

        // Jika notifikasi tidak ditemukan, arahkan kembali
        return redirect()->route('notifikasi.index');
    }
}
