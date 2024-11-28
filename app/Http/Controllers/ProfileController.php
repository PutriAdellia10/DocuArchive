<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
{
    // Ambil data pengguna yang sedang login
    $user = Auth::user();

    // Tampilkan view edit profil
    return view('profile.edit', compact('user'));
}

public function update(Request $request)
{
    $user = Auth::user();
    $validatedData = $request->validate([
        'nama_pengguna' => 'required|string|max:255|unique:pengguna',
        'email' => 'required|email|unique:pengguna',
        'kata_sandi' => 'required|string|min:8',
    ]);

    // Hash password jika ada
    if ($request->has('kata_sandi') && !empty($request->kata_sandi)) {
        $validatedData['kata_sandi'] = bcrypt($request->kata_sandi);
    }

    $user->update($validatedData);

    return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
}
}
