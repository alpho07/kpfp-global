<?php

namespace App\Traits;

use App\Scopes\InstitutionScope, Auth;

trait BelongsToInstitution
{
    protected static function bootBelongsToInstitution()
    {

        //static::addGlobalScope(new FacilityScope);
        //if (static::class !== \App\Models\Institution::class) {

        static::addGlobalScope(new InstitutionScope);

        // }
    }
}
