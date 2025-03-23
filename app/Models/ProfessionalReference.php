<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalReference extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'professional_references';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'checklist',
        'application_id',
        'scholarship_id',
        'reference_title',
        'reference_full_name',
        'reference_organization',
        'reference_phone_no',
        'reference_email',
        'reference_job_title',
    ];

}
