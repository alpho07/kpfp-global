<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait AssignsInstitution
{
    protected static function bootAssignsInstitution()
    {
        static::creating(function ($model) {
            $user = Auth::user();

            if ($user && !$model->institution_id) {
                $model->institution_id = $user->institution_id;
            }
        });

        static::updating(function ($model) {
            // Prevent changing facility_id on update
            if ($model->isDirty('institution_id')) {
                $model->institution_id = $model->getOriginal('institution_id');
            }
        });
    }
}
