<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diskon extends Model
{
    use HasFactory;

    public $table = 'diskons';

    protected $fillable = [
        'id',
        'id_kamar',
        'jumlah_diskon',
        'keterangan',
        'harga_baru',
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar');
    }
}
