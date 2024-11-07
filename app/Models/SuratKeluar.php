<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan
    protected $table = 'surat_keluar';

    // Definisikan kolom yang dapat diisi
    protected $fillable = [
        'no_surat',
        'tanggal_pembuatan',
        'judul_surat',
        'isi',
        'tujuan',
        'lampiran',
        'status_review',
        'status_pengiriman',
        'status_arsip',
    ];

    // Relasi dengan pengguna (tujuan)
    public function pengguna()
    {
        return $this->belongsTo(User::class, 'tujuan'); // 'tujuan' adalah kolom yang merujuk ke id pengguna
    }
    // Jika perlu, tambahkan metode lain untuk logika bisnis
}
