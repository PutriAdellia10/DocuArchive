<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSurat extends Model
{
    protected $table = 'template_surat';

    protected $fillable = [
        'nama_template',
        'konten',
        'ttd_pimpinan',
        'stempel',
    ];

    public function surat()
    {
        return $this->hasMany(Surat::class, 'id_template');
    }
}
