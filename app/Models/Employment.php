<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'checklist',
        'application_id',
        'scholarship_id',
        'previous_organization',
        'previous_organization_from',
        'reference_previous_organization_to',
        'reference_previous_job_title',
        'reference_previous_supervisor',
        'reference_previous_responsibilities',
        'reference_previous_phone_no',
    ];


}
