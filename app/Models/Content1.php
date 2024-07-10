<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content1 extends Model
{
    use HasFactory;

    public $table = 'content1s';

    protected $fillable = [
        'gambar',
        'teks',
    ];
}
