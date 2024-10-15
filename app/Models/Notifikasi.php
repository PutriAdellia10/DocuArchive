<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notifikasi extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'notifikasi';

    // Kolom yang dapat diisi (fillable) menggunakan mass assignment
    protected $fillable = [
        'id_pengguna',
        'pesan',
        'sudah_dibaca',
        'dibuat_pada'
    ];

    // Kolom timestamps bawaan Laravel tidak digunakan, jadi nonaktifkan
    public $timestamps = false;

    // Kolom yang harus dianggap sebagai tipe tanggal
    protected $dates = ['dibuat_pada'];

    // Relasi ke model Pengguna (assumed to be 'User')
    public function pengguna()
    {
        return $this->belongsTo(User::class, 'id_pengguna');
    }
}
