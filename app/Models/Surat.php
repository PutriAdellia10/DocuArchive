<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Surat extends Model
{
 use HasFactory ;

    protected $table = 'surat'; // Pastikan nama tabel sesuai dengan database
    protected $primaryKey = 'id'; // Nama primary key
    public $incrementing = true; // Auto increment primary key
    protected $keyType = 'int'; // Tipe primary key
    const CREATED_AT = 'created_at'; // Nama kolom created_at
    const UPDATED_AT = 'updated_at'; // Nama kolom updated_at

    protected $fillable = [
        'no_agenda',
        'tanggal',
        'no_surat',
        'tanggal_surat',
        'perihal',
        'konten',
        'id_sifat_surat',
        'id_asal_surat',
        'dokumen',
        'status',
    ];

    protected $dates = [
        'tanggal',
        'tanggal_surat',
    ];

    // Relasi dengan model lain
    public function instansi()
    {
        return $this->belongsTo(Instansi::class, 'id_asal_surat');
    }

    public function sifatSurat()
    {
        return $this->belongsTo(SifatSurat::class, 'id_sifat_surat');
    }
    public function rekapitulasi()
    {
        return $this->hasOne(RekapitulasiSurat::class, 'id_surat');
    }
    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'surat_id');
    }
    // Accessor untuk status
    public function getStatusAttribute($value)
    {
        return $value === 'masuk' ? 'Masuk' : 'Keluar';
    }

    // Mutator untuk status
    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = strtolower($value);
    }
}
