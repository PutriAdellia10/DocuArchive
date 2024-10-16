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
       // Get all disposisi entries
    $disposisiEntries = Disposisi::all();

    // Get disposisi entries for a specific surat
    $disposisi = Disposisi::where('surat_id', $suratId)->get();

        return view('disposisi.index', compact('disposisi','disposisiEntries'));
    }

    // Menampilkan detail disposisi
    public function show($id)
    {
        $surat = Surat::findOrFail($id);
        $disposisiEntries = Disposisi::where('surat_id', $id)->get();

        // Pass both surat and disposisiEntries to the view
        return view('layout.disposisi', compact('surat', 'disposisiEntries'));
    }

    // Menampilkan form untuk membuat disposisi baru
    public function create()
    {
        return view('disposisi.create');
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'tindakan' => 'required|array', // Make sure tindakan is an array
            'kepada' => 'required|string',
            'keterangan' => 'nullable|string',
            'surat_id' => 'required|integer',
        ]);

        // Convert tindakan to JSON properly
        $tindakan = json_encode($request->tindakan); // Properly encode tindakan as JSON

        // Create a new Disposisi entry
        Disposisi::create([
            'surat_id' => $request->surat_id,
            'tindakan' => $tindakan, // Store as JSON
            'kepada' => $request->kepada,
            'keterangan' => $request->keterangan,
            'dari' => auth()->user()->name, // Assuming you want to store the sender
        ]);

        return redirect()->back()->with('success', 'Disposisi telah dikirim!');
    }

    public function kirim(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'tindakan' => 'required|array', // Ensure tindakan is an array
            'kepada' => 'required|string',
            'keterangan' => 'nullable|string',
            'surat_id' => 'required|integer', // Validate surat_id is present
        ]);

        // Encode tindakan array to JSON
        $tindakan = json_encode($request->tindakan);

        // Create a new disposisi entry
        Disposisi::create([
            'surat_id' => $request->surat_id,
            'tindakan' => $tindakan, // Store tindakan as JSON
            'kepada' => $request->kepada,
            'keterangan' => $request->keterangan,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Disposisi telah dikirim!');
    }

    // Menghapus disposisi
    public function destroy($id)
    {
        $surat = Surat::findOrFail($id);
        $surat->delete();
        return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil dihapus.');
    }

}
