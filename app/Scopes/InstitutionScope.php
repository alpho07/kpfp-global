<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

class InstitutionScope implements Scope
{
    protected string $column = '';

    public function apply(Builder $builder, Model $model)
    {
        // Skip applying scope to User model to avoid recursion
        if ($model instanceof \App\Models\User) {
            return;
        }

        // Determine the column name for filtering
        $this->column = $model instanceof \App\Models\Institution ? 'id' : 'institution_id';

        // Get the authenticated user
        $user = Auth::user();

        // If user is not logged in (guest), do not filter institution
        if (!$user) {
            return;
        }

        // Retrieve user roles and institution ID
        $roles = $user->roles->pluck('name')->toArray(); // Assuming Spatie Roles
        $institution_id = $user->institution_id;

        // Super Admin has unrestricted access (no filtering)
        if (in_array('Super Admin', $roles)) {
            return;
        }

        // If the user is a student or has no role, do not filter institution
        if (empty($roles) || in_array('Student', $roles)) {
            return;
        }

        // Apply institution filter for other roles
        $builder->where($this->column, $institution_id);
    }
}
