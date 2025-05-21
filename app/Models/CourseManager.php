<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseManager extends Model {

    //use SoftDeletes;

    public $table = 'course_manager';
    protected $with = ['category', 'period'];
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

    public function getStatusAttribute(): string {
        $now = now();

        if ($this->application_start_date && $this->application_end_date) {
            if ($now->between($this->application_start_date, $this->application_end_date)) {
                return 'Active';
            } elseif ($now->lt($this->application_start_date)) {
                return 'Upcoming';
            } elseif ($now->gt($this->application_end_date)) {
                return 'Closed';
            }
        }

        return 'Unscheduled'; // fallback if dates are missing
    }

    public function getDaysLeftAttribute(): ?int {
        if ($this->status === 'Active') {
            return now()->diffInDays($this->application_end_date, false);
        }

        return null;
    }

    public function getOpensInAttribute(): ?int {
        if ($this->status === 'upcoming') {
            return now()->diffInDays($this->application_start_date, false);
        }

        return null;
    }

    public function scopeActive($query) {
        return $query->whereDate('application_start_date', '<=', now())
                        ->whereDate('application_end_date', '>=', now());
    }

    public function scopeUpcoming($query) {
        return $query->whereDate('application_start_date', '>', now());
    }

    public function scopeClosed($query) {
        return $query->whereDate('application_end_date', '<', now());
    }

    /**
     * Get the category that owns the course.
     */
    public function category(): BelongsTo {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    /**
     * Get the month associated with the course.
     */
    public function period(): HasOne {
        return $this->hasOne(Period::class, 'id', 'month_id');
    }
}
