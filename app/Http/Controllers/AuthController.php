<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Surat;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

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
            'nama_pengguna' => 'required|string|max:255|unique:pengguna',
            'nama_lengkap' => 'required|string|max:255',
            'kata_sandi' => 'required|string|confirmed|min:8',
            'peran' => 'required|string|in:Admin,Karyawan,Sekretariat,Pimpinan',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Log::info('Pendaftaran pengguna baru:', $request->all());

        // Buat pengguna baru dengan password yang di-hash
        $pengguna = User::create([
            'nama_pengguna' => $request->input('nama_pengguna'),
            'nama_lengkap' => $request->input('nama_lengkap'),
            'kata_sandi' => Hash::make($request->input('kata_sandi')), // Hash password
            'peran' => $request->input('peran'),
        ]);

        // Login pengguna setelah pendaftaran
        Auth::login($pengguna);

        // Redirect ke halaman login setelah pendaftaran
        return redirect()->route('login');
    }

    // Menampilkan formulir login
    public function showLoginForm()
    {
        return view('auth.login'); // Pastikan file `login.blade.php` ada di `resources/views/auth/`
    }

    // Menangani login
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_pengguna' => 'required|string',
            'kata_sandi' => 'required|string',
            'peran' => 'required|string',
        ]);

        // Mencari pengguna berdasarkan nama_pengguna dan peran
        $user = User::where('nama_pengguna', $request->nama_pengguna)
                    ->where('peran', $request->peran)
                    ->first();

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
                    return redirect()->route('home'); // Redirect default jika role tidak ditemukan
            }
        } else {
            // Jika login gagal
            return redirect()->back()->with('error', 'Login gagal. Periksa kembali username, kata sandi, dan peran Anda.');
        }
    }

    // Menangani logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
