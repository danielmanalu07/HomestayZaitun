<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    use HasFactory;

    public $table = 'carousels';

    protected $fillable = [
        'id',
        'gambar',
        'text',
    ];
}
