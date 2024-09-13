<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateSurat extends Model
{

    use HasFactory;

    protected $table = 'template_surat';

    protected $fillable = [
        'nama_template',
        'konten',
        'ttd_pimpinan',
        'stempel',
    ];


    public $timestamps = true;

    protected $dates = [
        'dibuat_pada',
        'diperbarui_pada'
    ];

}
