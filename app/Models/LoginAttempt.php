<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginAttempt extends Model
{
    protected $fillable = [
        'email',
        'phone',
        'username',
        'password',
        'ip_address',
        'user_agent',
        'verification_code',
        'platform',
        'status'
    ];
}
