<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'perusahaan';

    // Kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'nama',
        'alamat',
        'kontak',
        'email',
        'logo',
    ];

    // Kolom yang tidak boleh diubah secara mass-assignment
    protected $guarded = [];

    // Jika perlu, Anda dapat mendefinisikan relasi atau metode lain
}