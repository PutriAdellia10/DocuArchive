<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;

    protected $table = 'instansi'; // Nama tabel di database

    protected $fillable = [
        'nama_instansi',
        'kontak',
        'jenis_kerja_sama',
    ];

    public $timestamps = true; // Mengaktifkan fitur timestamp

    public function surat()
    {
        return $this->hasMany(Surat::class, 'id_instansi','id');
    }
    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'sifat_surat_id');
    }
}

