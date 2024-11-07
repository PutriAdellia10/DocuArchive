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
        'dokumen',
        'nama_jabatan_penerima', // Menambahkan kolom sesuai dengan database
        'alamat_penerima',
        'tanggal_surat',
        'isi_surat',
        'nama_pengirim',
    ];

    public $timestamps = true;

    protected $dates = [
        'dibuat_pada',
        'diperbarui_pada',
        'tanggal_surat', // Jika kolom ini merupakan tipe tanggal
    ];

    protected $casts = [
        'tanggal_surat' => 'date', // Jika perlu, cast 'tanggal_surat' sebagai tipe date
    ];
}
