<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    use HasFactory;

    public $table = 'kamars';

    protected $fillable = [
        'id',
        'no_kamar',
        'harga_kamar',
        'kapasitas',
        'deskripsi',
        'status',
        'view',
        'id_kategori',
    ];

    public function kategoriKamar()
    {
        return $this->belongsTo(KategoriKamar::class, 'id_kategori');
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }
}
