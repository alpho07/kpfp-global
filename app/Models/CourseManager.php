<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseManager extends Model
{
    //use SoftDeletes;

    public $table = 'course_manager';
    protected $with = ['category','period'];

    protected $dates = [
        'created_at',
        'updated_at',
        //'deleted_at',
    ];

    protected $fillable = [
        'name',
        'category_id',
        'month_id',
        'created_at',
        'updated_at',
        //'deleted_at',
    ];
    
     
    

    /**
     * Get the category that owns the course.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    /**
     * Get the month associated with the course.
     */
    public function period(): HasOne
    {
        return $this->hasOne(Period::class, 'id', 'month_id');
    }
}
