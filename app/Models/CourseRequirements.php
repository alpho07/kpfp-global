<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CourseRequirements extends Model {

   // use SoftDeletes;

    public $table = 'course_requirements';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'course_id',
        'text',
        'mandatory',
        'created_at',
        'updated_at',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }
}
