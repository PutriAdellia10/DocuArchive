<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->get('search');
        $instansi = Instansi::where('nama_instansi', 'LIKE', "%$search%")
            ->paginate(10);

        return view('layout.instansi', compact('instansi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'jenis_kerja_sama' => 'required|string|max:255',
            'dibuat_pada' => 'required|date',
            'diperbarui_pada' => 'required|date',
        ]);

        Instansi::create([
            'nama_instansi' => $request->nama_instansi,
            'kontak' => $request->kontak,
            'jenis_kerja_sama' => $request->jenis_kerja_sama,
            'dibuat_pada' => $request->dibuat_pada,
            'diperbarui_pada' => $request->diperbarui_pada,
        ]);

        return redirect()->route('instansi.index');
    }

    public function edit($id)
    {
        $instansi = Instansi::findOrFail($id);
        return response()->json($instansi);
    }
    public function update(Request $request, $id)
    {
        \Log::info($request->all());
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'jenis_kerja_sama' => 'required|string|max:255',
        ]);

        $instansi = Instansi::findOrFail($id);
        $instansi->update([
            'nama_instansi' => $request->nama_instansi,
            'kontak' => $request->kontak,
            'jenis_kerja_sama' => $request->jenis_kerja_sama,
        ]);

        return redirect()->route('instansi.index');
    }

    public function destroy($id)
    {
        $instansi = Instansi::findOrFail($id);
        $instansi->delete();

        return redirect()->route('instansi.index');

    }
}
