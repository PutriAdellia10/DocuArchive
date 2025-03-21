<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Menampilkan formulir pendaftaran
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Menangani pendaftaran pengguna baru
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nama_pengguna' => 'required|string|max:50|unique:pengguna', // tabel "pengguna"
            'email' => 'required|email|max:100|unique:pengguna', // email harus unik
            'jabatan' => 'nullable|string|max:100', // jabatan opsional
            'kata_sandi' => 'required|string|confirmed|min:8',
            'peran' => 'required|string|in:Admin,Karyawan,Sekretariat,Pimpinan',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Set peran berdasarkan input jabatan
        $peran = $request->input('jabatan') ? 'Karyawan' : $request->input('peran');

        // Buat pengguna baru dengan password yang di-hash
        $pengguna = User::create([
            'nama_pengguna' => $request->input('nama_pengguna'),
            'email' => $request->input('email'),
            'jabatan' => $request->input('jabatan'), // jika ada jabatan
            'kata_sandi' => Hash::make($request->input('kata_sandi')), // Hash password
            'peran' => $request->input('peran'),
        ]);

        // Redirect ke halaman login setelah pendaftaran berhasil
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    // Menampilkan formulir login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menangani login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|string', // Mengganti nama_pengguna dengan email
            'kata_sandi' => 'required|string',
        ]);

        // Mencari pengguna berdasarkan email dan peran
        $user = User::where('email', $request->email)->first();

        // Jika pengguna ditemukan dan password cocok
        if ($user && Hash::check($request->kata_sandi, $user->kata_sandi)) {
            Auth::login($user);

            // Cek peran (role) dan redirect ke halaman dashboard yang sesuai
            switch ($user->peran) {
                case 'Admin':
                    return redirect()->intended('/dashboard_admin');
                case 'Sekretariat':
                    return redirect()->intended('/dashboard_sekretariat');
                case 'Karyawan':
                    return redirect()->intended('/dashboard_karyawan');
                case 'Pimpinan':
                    return redirect()->intended('/dashboard_pimpinan');
                default:
                    return redirect()->route('home');
            }
        } else {
            // Jika login gagal
            return redirect()->back()->with('error', 'Login gagal. Periksa kembali email dan kata sandi Anda.');
        }
    }

    // Menangani logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
