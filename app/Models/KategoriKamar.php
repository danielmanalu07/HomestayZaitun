<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKamar extends Model
{
    use HasFactory;

    public $table = 'kategori_kamars';

    protected $fillable = [
        'id',
        'nama',
        'deskripsi',
    ];
}
