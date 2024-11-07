<?php

namespace App\Http\Controllers;

use App\Models\TemplateSurat;
use App\Models\Surat; // Include the Surat model
use Illuminate\Http\Request;

class TemplateSuratController extends Controller
{
    // Display all templates
    public function index()
    {
        $templates = TemplateSurat::all();
        return view('layout.templatesurat', compact('templates'));
    }

    // Show form to create a new template
    public function create()
    {
        return view('template_surat.create');
    }

    // Store new template
    public function store(Request $request)
    {
        $request->validate([
            'nama_template' => 'required|max:100',
            'konten' => 'required',
            'ttd_pimpinan' => 'nullable|file|mimes:jpg,png',
            'stempel' => 'nullable|file|mimes:jpg,png',
            'nama_jabatan_penerima' => 'required|max:100',
            'alamat_penerima' => 'required',
            'tanggal_surat' => 'required|date',
            'isi_surat' => 'required',
            'nama_pengirim' => 'required|max:100',
        ]);

        $data = $request->only([
            'nama_template',
            'konten',
            'nama_jabatan_penerima',
            'alamat_penerima',
            'tanggal_surat',
            'isi_surat',
            'nama_pengirim',
        ]);

        // Handle file uploads
        if ($request->hasFile('ttd_pimpinan')) {
            $data['ttd_pimpinan'] = $request->file('ttd_pimpinan')->store('ttd', 'public');
        }

        if ($request->hasFile('stempel')) {
            $data['stempel'] = $request->file('stempel')->store('stempel', 'public');
        }

        // Create the template
        TemplateSurat::create($data);

        return redirect()->route('template_surat.index')->with('success', 'Template Surat created successfully');
    }

    // Show form to edit an existing template
    public function edit($id)
    {
        $template = TemplateSurat::findOrFail($id);
        return view('template_surat.edit', compact('template'));
    }

    // Update an existing template
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_template' => 'required|max:100',
            'konten' => 'required',
            'ttd_pimpinan' => 'nullable|file|mimes:jpg,png',
            'stempel' => 'nullable|file|mimes:jpg,png',
            'nama_jabatan_penerima' => 'required|max:100',
            'alamat_penerima' => 'required',
            'tanggal_surat' => 'required|date',
            'isi_surat' => 'required',
            'nama_pengirim' => 'required|max:100',
        ]);

        $template = TemplateSurat::findOrFail($id);

        $data = $request->only([
            'nama_template',
            'konten',
            'nama_jabatan_penerima',
            'alamat_penerima',
            'tanggal_surat',
            'isi_surat',
            'nama_pengirim',
        ]);

        // Handle file uploads
        if ($request->hasFile('ttd_pimpinan')) {
            $data['ttd_pimpinan'] = $request->file('ttd_pimpinan')->store('ttd', 'public');
        }

        if ($request->hasFile('stempel')) {
            $data['stempel'] = $request->file('stempel')->store('stempel', 'public');
        }

        // Update the template
        $template->update($data);

        return redirect()->route('template_surat.index')->with('success', 'Template Surat updated successfully');
    }

    // Delete an existing template
    public function destroy($id)
    {
        $template = TemplateSurat::findOrFail($id);
        $template->delete();

        return redirect()->route('template_surat.index')->with('success', 'Template Surat deleted successfully');
    }

    // Generate a new surat based on the template
    public function generate(Request $request, $id)
    {
        $template = TemplateSurat::findOrFail($id);

        // Create a new surat entry based on the template
        $suratData = [
            'template_id' => $template->id,
            'konten' => $template->konten,
            'ttd_pimpinan' => $template->ttd_pimpinan,
            'stempel' => $template->stempel,
            'nama_jabatan_penerima' => $template->nama_jabatan_penerima,
            'alamat_penerima' => $template->alamat_penerima,
            'tanggal_surat' => $template->tanggal_surat,
            'isi_surat' => $template->isi_surat,
            'nama_pengirim' => $template->nama_pengirim,
        ];

        // Create the surat
        Surat::create($suratData);

        return redirect()->route('surat.index')->with('success', 'Surat generated successfully');
    }
}
