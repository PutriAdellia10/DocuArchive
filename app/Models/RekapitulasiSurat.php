<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapitulasiSurat extends Model
{
    use HasFactory;

    protected $table = 'rekapitulasi_surat';

    protected $fillable = [
        'tahun',
        'bulan',
        'surat_masuk',
        'surat_keluar',
        'id_surat',
    ];
}
