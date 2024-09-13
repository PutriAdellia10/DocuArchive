<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    protected $table = 'disposisi';

    protected $fillable = [
        'id_surat',
        'id_pengguna',
        'instruksi',
        'status',
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'id_surat');
    }

    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'id_pengguna');
    }
}
