<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'surat_masuk';

    // Definisikan kolom yang dapat diisi
    protected $fillable = [
        'no_surat',
        'pengirim_id',
        'instansi_id',
        'nama_pengirim_eksternal',
        'kontak_pengirim_eksternal',
        'tanggal',
        'subjek',
        'isi',
        'lampiran',
        'status_disposisi',
        'catatan',
        'status_arsip',
    ];

    // Relasi dengan pengguna (pengirim)
    public function pengirim()
    {
        return $this->belongsTo(User::class, 'pengirim_id');
    }

    // Relasi dengan instansi
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'instansi_id');
    }

    // Jika perlu, tambahkan metode lain untuk logika bisnis
}
