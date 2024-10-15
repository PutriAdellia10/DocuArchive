<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan
    protected $table = 'notifikasi';

    protected $fillable = [
        'id_pengguna', 'pesan', 'sudah_dibaca', 'dibuat_pada', 'data',
    ];

    protected $casts = [
        'data' => 'array', // Field 'data' disimpan sebagai array
    ];

    public $timestamps = false; // Jika tidak ada kolom 'created_at' dan 'updated_at'
}
