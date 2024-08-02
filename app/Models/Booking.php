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
        'total_harga',
        'rating',
        'status',
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_kamar');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
