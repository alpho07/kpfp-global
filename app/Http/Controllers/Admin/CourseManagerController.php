<?php

namespace App\Http\Controllers\Admin;

use App\Models\CourseCategory;
use App\Models\CourseManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDisciplineRequest;
use App\Http\Requests\StoreDisciplineRequest;
use App\Http\Requests\UpdateCourseCategoryRequest;
use App\Http\Requests\UpdateDisciplineRequest;
use App\Models\Period;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseManagerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('discipline_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disciplines = CourseManager::all();

        return view('admin.course_manager.index', compact('disciplines'));
    }

    public function create()
    {
        abort_if(Gate::denies('discipline_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = CourseCategory::all();
        $months = Period::all();
       
   

        return view('admin.course_manager.create',compact('categories','months'));
    }

    public function store(Request $request)
    {
        $discipline = CourseManager::create($request->all());

        return redirect()->route('admin.course-manager.index');
    }

    public function edit($discipline)
    {
        abort_if(Gate::denies('discipline_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $discipline = CourseManager::find($discipline);
        $categories = CourseCategory::all();
        $months = Period::all();
        return view('admin.course_manager.edit', compact('discipline','categories','months'));
    }

    public function update(Request $request, $discipline)
    {
        $discipline = CourseManager::find($discipline);
        $discipline->update($request->all());

        return redirect()->route('admin.course-manager.index');
    }

    public function show($discipline)
    {

        abort_if(Gate::denies('discipline_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $discipline = CourseManager::find($discipline);
        return view('admin.course_manager.show', compact('discipline'));
    }

    public function destroy($discipline)
    {
        abort_if(Gate::denies('discipline_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $discipline = CourseManager::find($discipline);
        $discipline->delete();

        return back();
    }

    public function massDestroy(MassDestroyDisciplineRequest $request)
    {
        CourseManager::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
