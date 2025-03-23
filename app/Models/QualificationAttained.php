<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QualificationAttained extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'qualification_attained';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'checklist',
        'application_id',
        'scholarship_id',
        'training_institution',
        'training_institution_start_date',
        'training_institution_completion',
        'training_institution_attained',
    ];


}
