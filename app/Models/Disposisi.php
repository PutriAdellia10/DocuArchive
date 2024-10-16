<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'disposisi'; // Optional if your table name is the plural form of the model name

    // Specify the fillable attributes
    protected $fillable = [
        'surat_id',     // ID of the related surat
        'tindakan',     // Action to take
        'kepada',       // Recipient
        'keterangan',   // Description or additional information
    ];

    // Optionally, you can define casts if needed
    protected $casts = [
        'created_at' => 'datetime', // Cast created_at to a Carbon instance
        'updated_at' => 'datetime', // Cast updated_at to a Carbon instance
    ];
}
