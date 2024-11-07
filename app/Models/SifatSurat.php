<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SifatSurat extends Model
{
    use HasFactory;

    protected $table = 'sifat_surat';

    protected $fillable = [
        'nama_sifat',
        'deskripsi',
    ];

    // Menonaktifkan timestamps
    public $timestamps = false;

    public function surat()
    {
        return $this->hasMany(Surat::class, 'id_sifat_surat','id');
    }
    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'sifat_surat_id');
    }
}

