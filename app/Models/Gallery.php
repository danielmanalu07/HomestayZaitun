<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    public $table = 'galleries';

    protected $fillable = [
        'id',
        'gambar_utama',
        'gambar2',
        'gambar3',
        'gambar4',
        'id_kamar',
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar');
    }
}
