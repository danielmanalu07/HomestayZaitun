<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    public $table = 'password_resets';

    protected $fillable = [
        'id',
        'user_id',
        'email',
        'phone',
        'token',
        'verification_code',
        'verification_date',
        'expires_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
