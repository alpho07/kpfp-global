<?php

namespace App\View\Composers;

use App\Models\Discipline;
use App\Models\Institution;
use Illuminate\View\View;


class MenuComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('menuDisciplines', Discipline::withCount('courses')->whereHas('courses')->pluck('name', 'id'));
        $view->with('menuInstitutions', Institution::withCount('courses')->whereHas('courses')->pluck('name', 'id'));
    }
}
