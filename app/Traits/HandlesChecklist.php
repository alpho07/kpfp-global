<?php

namespace App\Traits;

use App\Models\Checklist;
use App\Models\ChecklistStudent;
use Illuminate\Support\Facades\Auth;

trait HandlesChecklist
{
    public $checklist;

    public function getChecklistHandler()
    {
        if (!$this->checklist) {
            $user = Auth::check() ? Auth::user() : null;

            if ($user) {
                $role = $user->roles()->pluck('name')->toArray();
                $this->checklist = in_array('Student', $role) ? new ChecklistStudent() : new Checklist();
            } else {
                $this->checklist = new Checklist(); // Default if no user is logged in
            }
        }
        return $this->checklist;
    }
}
