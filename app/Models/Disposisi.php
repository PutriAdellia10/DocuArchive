<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;

    // Nama tabel dalam database
    protected $table = 'disposisi';

    // Kolom-kolom yang dapat diisi
    protected $fillable = [
        'surat_id',
        'tindakan',
        'kepada',
        'keterangan',
        'lampiran',
        'catatan',
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id');
    }

    /**
     * Customisasi timestamps jika diperlukan.
     * Jika tidak perlu, Anda bisa menghapus atau mengubahnya sesuai keperluan.
     */
    public $timestamps = true;
}
