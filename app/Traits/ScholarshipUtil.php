<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use \App\Models\Applications;

trait ScholarshipUtil {

    public function getHasPendingApplicationAttribute() {
        if (!auth()->check()) {
            return false;
        }

        return Applications::where('application_id', auth()->id())
                        ->whereNotIn('status', ['Enrolled','Cancelled'])
                        ->exists();
    }
}
