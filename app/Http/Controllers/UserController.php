<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'nama_pengguna' => 'required|string|max:255|unique:pengguna',
        'email' => 'required|email|unique:pengguna',
        'kata_sandi' => 'required|string|min:8',
        'peran' => 'required|string|in:admin,karyawan,sekretariat,pimpinan',
        'jabatan' => 'nullable|string|max:255',
    ]);

    // Buat dan simpan user baru
    User::create([
        'nama_pengguna' => $request->nama_pengguna,
        'email' => $request->email,
        'kata_sandi' => bcrypt($request->kata_sandi),
        'peran' => $request->peran,
        'jabatan' => $request->jabatan,
    ]);

    return redirect()->route('user.profil')->with('success', 'User berhasil ditambahkan');
}


    public function show()
    {
        $pengguna = User::all();
        $total = $pengguna->count(); // Hitung total data secara manual
        return view('layout.manajemenprofil', compact('pengguna', 'total'));
    }

      // Menampilkan halaman edit
      public function edit($id)
      {
          $user = User::findOrFail($id);
          return view('layout.edituser', compact('user'));
      }
      //Update
        public function update(Request $request, $id)
        {
        $user = User::findOrFail($id);

        $user->nama_pengguna = $request->input('nama_pengguna');
        if ($request->filled('kata_sandi')) {
            $user->kata_sandi = bcrypt($request->input('kata_sandi'));
        }
        $user->peran = $request->input('peran');

        $user->save();

        return redirect()->route('user.profil')->with('success', 'User berhasil diperbarui');
        }

    // Menghapus pengguna
    public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('user.profil')->with('success', 'User berhasil dihapus');
}

}

