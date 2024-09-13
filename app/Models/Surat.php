<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $table = 'surat'; // Nama tabel di database, jika berbeda

    protected $fillable = [
        'status',
    ];
}
