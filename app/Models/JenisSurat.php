<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    protected $table = 'jenis_surat';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'nama_jenis',
        'deskripsi',

    ];

    public function surat()
    {
        return $this->hasMany(Surat::class, 'id_jenis_surat');
    }
}
