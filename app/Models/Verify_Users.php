<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verify_Users extends Model
{
    use HasFactory;

    public $table = 'verify_users';

    protected $fillable = [
        'id',
        'user_id',
        'token',
        'code',
        'verification_date',
        'expires_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
