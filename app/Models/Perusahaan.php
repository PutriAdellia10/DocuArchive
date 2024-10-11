<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $table = 'profil_perusahaan'; // Pastikan tabel ini ada di database

    protected $fillable = ['visi', 'misi', 'alamat', 'kontak', 'dibuat_pada', 'diperbarui_pada'];

    public $timestamps = false; // Nonaktifkan jika tidak ada kolom created_at dan updated_at
}
