<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'pengguna'; // Pastikan tabel 'pengguna'

    protected $fillable = [
        'nama_pengguna',
        'nama_lengkap',
        'kata_sandi',
        'peran',
    ];

    protected $hidden = [
        'kata_sandi',
    ];

    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';
}
