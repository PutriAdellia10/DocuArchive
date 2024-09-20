<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{

    // Nama tabel
    protected $table = 'instansi';

    // Kolom timestamp yang tidak default
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    // Atribut yang dapat diisi

    protected $fillable = [
        'nama_instansi',
        'kontak',
        'jenis_kerja_sama',

        'dibuat_pada',
        'diperbarui_pada',
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

