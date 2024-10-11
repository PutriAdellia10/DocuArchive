<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;

    protected $table = 'disposisi';

    protected $fillable = [
        'surat',
        'pengguna',
        'instruksi',
        'status',
        'dibuat_pada',
    ];


    public $timestamps = false;
}


