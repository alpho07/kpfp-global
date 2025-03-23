<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messaging extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messaging';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
        'user',
    ];
}
