<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
     // Menampilkan semua notifikasi pengguna
     public function index()
     {
         $idPengguna = auth()->id(); // Mengambil ID pengguna yang sedang login
         $notifikasi = Notifikasi::where('id_pengguna', $idPengguna)
                          ->orderBy('dibuat_pada', 'desc')
                          ->get();

         return view('notifikasi.index', compact('notifikasi'));
     }

     // Tandai notifikasi sebagai sudah dibaca
     public function markAsRead($id)
     {
         $notifikasi = Notifikasi::findOrFail($id);
         $notifikasi->sudah_dibaca = true;
         $notifikasi->save();

         return redirect()->back()->with('status', 'Notifikasi telah ditandai sebagai dibaca');
     }

     // Membuat notifikasi baru (bisa untuk testing atau event)
     public function create(Request $request)
     {
         Notifikasi::create([
             'id_pengguna' => $request->input('id_pengguna'),
             'pesan' => $request->input('pesan'),
             'sudah_dibaca' => false,
         ]);

         return redirect()->back()->with('status', 'Notifikasi berhasil ditambahkan');
     }
 }
