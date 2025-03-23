<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentProof extends Model
{
    use HasFactory;


    protected $fillable = [
        'application_id',
        'scholarship_id',
        'link',
        'proof',
    ];
}
