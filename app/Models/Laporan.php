<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari konvensi (opsional)
    protected $table = 'laporan';

    // Kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'no_agenda',
        'tanggal',
        'asal_surat',
        'no_surat',
        'tanggal_surat',
        'perihal',
        'keterangan',
        'sifat_surat_id',
        'status',
    ];

    // Tentukan tipe data untuk kolom tanggal
    protected $dates = [
        'tanggal',
        'tanggal_surat',
        'dihasilkan_pada',
    ];

    // Relasi ke tabel `instansi` (relasi many-to-one)
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'asal_surat');
    }

    // Relasi ke tabel `sifat_surat` (relasi many-to-one)
    public function sifatSurat()
    {
        return $this->belongsTo(SifatSurat::class, 'sifat_surat_id');
    }

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id');
    }
}
