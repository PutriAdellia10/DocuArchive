<?php

namespace App\Http\Controllers;

use App\Models\TemplateSurat;
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
        ]);

        $data = $request->only(['nama_template', 'konten']);

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
        ]);

        $template = TemplateSurat::findOrFail($id);

        $data = $request->only(['nama_template', 'konten']);

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
}
