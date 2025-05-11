<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $table = 'password_resets';
    protected $primaryKey = 'email';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['email', 'token', 'created_at'];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}