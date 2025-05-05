<?php

namespace App\Models;

use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable, HasApiTokens, HasRoles;

    public $table = 'users';

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'email_verified_at',
    ];

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'id_number',
        'email',
        'password',
        'gender',
        'phone',
        'dob',
        'otp',
        'otp_expires_at',
        'is_verified',
        'country',
        'county',
        'created_at',
        'updated_at',
        'deleted_at',
        'remember_token',
        'institution_id',
        'email_verified_at',
    ];

    protected $with = ['roles'];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class, 'user_id', 'id');
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }



    public function getFirstNameAttribute()
    {
        return explode(' ', $this->attributes['first_name'])[0];
    }


    public function getLastNameAttribute()
    {
        $nameParts = explode(' ', $this->attributes['last_name']);

        return count($nameParts) > 1 ? end($nameParts) : null;
    }


    public function setNameAttribute($value)
    {
        $this->attributes['first_name'] = $value;
    }


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function institution()
    {
        return $this->belongsTo(Institution::class, 'institution_id');
    }

    public function isInstitution()
    {
        return $this->roles->contains(2);
    }
}
