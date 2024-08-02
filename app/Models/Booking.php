<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    public $table = 'bookings';

    protected $fillable = [
        'id',
        'id_user',
        'id_kamar',
        'check_in',
        'check_out',
        'catatan',
        'jumalah_orang',
        'rating',
        'status',
    ];
}
