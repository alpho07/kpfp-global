<?php

namespace App\Models;

use App\Scopes\CourseScope;
use App\Models\CourseManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Course extends BaseModel implements HasMedia {

    use SoftDeletes,
        InteractsWithMedia;

    public $table = 'courses';
    protected $with = 'course_manager';
    protected $appends = [
        'photo',
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
        'manager_id',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
        'description',
        'institution_id',
        'application_start_date',
        'application_end_date'
    ];
    protected $casts = [
    'application_start_date' => 'datetime',
    'application_end_date' => 'datetime',
];

    public function course_manager() {
        return $this->HasOne(\App\Models\CourseManager::class, 'id', 'manager_id');
    }

    public function registerMediaConversions(Media $media = null): void {
        $this->addMediaConversion('thumb')->width(50)->height(50);
    }

    public function enrollments() {
        return $this->hasMany(Enrollment::class, 'course_id', 'id');
    }

    public function getPhotoAttribute() {
        $file = $this->getMedia('photo')->last();

        if ($file) {
            $file->url = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
        }

        return $file;
    }

    public function institution() {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    public function course() {
        return $this->belongsTo(CourseManager::class, 'manager_id');
    }

    public function disciplines() {
        return $this->belongsToMany(Discipline::class);
    }

    public function getPrice() {
        return $this->price ? '$' . number_format($this->price, 2) : 'FREE';
    }

    public function scopeSearchResults($query) {
        $query->when(request('discipline'), function ($query) {
                    $query->whereHas('disciplines', function ($query) {
                        $query->whereId(request('discipline'));
                    });
                })
                ->when(request('institution'), function ($query) {
                    $query->whereHas('institution', function ($query) {
                        $query->whereId(request('institution'));
                    });
                });
    }

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

    public function getDaysLeftAttribute(): ?string {
        $now = now();

        if ($this->application_start_date && $this->application_end_date) {
            if ($now->between($this->application_start_date, $this->application_end_date)) {
                $days = round($now->diffInDays($this->application_end_date, false));
                return "$days Day" . ($days !== 1 ? 's' : '') . " Left";
            } elseif ($now->lt($this->application_start_date)) {
                $days = round($now->diffInDays($this->application_start_date, false));
                return "In $days Day" . ($days !== 1 ? 's' : '');
            } elseif ($now->gt($this->application_end_date)) {
                return "Closed";
            }
        }

        return "Unscheduled";
    }

    public function getOpensInAttribute(): ?int {
        if ($this->status === 'Upcoming') {
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
}
