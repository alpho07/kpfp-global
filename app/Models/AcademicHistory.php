<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicHistory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'academic_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'checklist',
        'application_id',
        'scholarship_id',
        'academic_university',
        'academic_start_date',
        'academic_completion',
        'academic_diplomas',
    ];

    public function application()
    {
        return $this->belongsTo(Applications::class, 'application_id', 'application_id')->where('scholarship_id', $this->scholarship_id);
    }
}
