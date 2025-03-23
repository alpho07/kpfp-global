<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Disclaimer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'disclaimer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'checklist',
        'application_id',
        'scholarship_id',
        'disclaimer_1',
        'disclaimer_2',
    ];
}
