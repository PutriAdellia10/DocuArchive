<?php

namespace App\Http\Controllers;

use App\Models\TemplateSurat;
use Illuminate\Http\Request;

class TemplateSuratController extends Controller
{
    // Menampilkan daftar template surat
    public function index()
    {
        $templateSurat = TemplateSurat::all();
        return view('template_surat.index', compact('templateSurat'));
    }

    // Menampilkan form untuk menambah template surat baru
    public function create()
    {
        return view('template_surat.create');
    }

    // Menyimpan template surat baru ke database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_template' => 'required|string|max:100',
            'konten' => 'required|string',
            'ttd_pimpinan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stempel' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('ttd_pimpinan')) {
            $validatedData['ttd_pimpinan'] = $request->file('ttd_pimpinan')->store('ttd_pimpinan', 'public');
        }

        if ($request->hasFile('stempel')) {
            $validatedData['stempel'] = $request->file('stempel')->store('stempel', 'public');
        }

        TemplateSurat::create($validatedData);

        return redirect()->route('template_surat.index')->with('success', 'Template surat berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit template surat
    public function edit($id)
    {
        $templateSurat = TemplateSurat::findOrFail($id);
        return view('template_surat.edit', compact('templateSurat'));
    }

    // Memperbarui template surat di database
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_template' => 'required|string|max:100',
            'konten' => 'required|string',
            'ttd_pimpinan' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stempel' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $templateSurat = TemplateSurat::findOrFail($id);

        if ($request->hasFile('ttd_pimpinan')) {
            $validatedData['ttd_pimpinan'] = $request->file('ttd_pimpinan')->store('ttd_pimpinan', 'public');
        }

        if ($request->hasFile('stempel')) {
            $validatedData['stempel'] = $request->file('stempel')->store('stempel', 'public');
        }

        $templateSurat->update($validatedData);

        return redirect()->route('template_surat.index')->with('success', 'Template surat berhasil diperbarui.');
    }

    // Menghapus template surat dari database
    public function destroy($id)
    {
        $templateSurat = TemplateSurat::findOrFail($id);
        $templateSurat->delete();

        return redirect()->route('template_surat.index')->with('success', 'Template surat berhasil dihapus.');
    }

    // Menampilkan detail template surat (opsional)
    public function show($id)
    {
        $templateSurat = TemplateSurat::findOrFail($id);
        return view('template_surat.show', compact('templateSurat'));
    }
}
