<?php

namespace App\Http\Controllers\Admin;

use App\Models\CourseCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyDisciplineRequest;
use App\Http\Requests\StoreDisciplineRequest;
use App\Http\Requests\UpdateCourseCategoryRequest;
use App\Http\Requests\UpdateDisciplineRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('discipline_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $disciplines = CourseCategory::all();

        return view('admin.course_category.index', compact('disciplines'));
    }

    public function create()
    {
        abort_if(Gate::denies('discipline_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.course_category.create');
    }

    public function store(StoreDisciplineRequest $request)
    {
        $discipline = CourseCategory::create($request->all());

        return redirect()->route('admin.course-category.index');
    }

    public function edit($discipline)
    {
        abort_if(Gate::denies('discipline_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $discipline = CourseCategory::find($discipline);
        return view('admin.course_category.edit', compact('discipline'));
    }

    public function update(UpdateCourseCategoryRequest $request, $discipline)
    {
        $discipline = CourseCategory::find($discipline);
        $discipline->update($request->all());

        return redirect()->route('admin.course-category.index');
    }

    public function show($discipline)
    {

        abort_if(Gate::denies('discipline_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $discipline = CourseCategory::find($discipline);
        return view('admin.course_category.show', compact('discipline'));
    }

    public function destroy($discipline)
    {
        abort_if(Gate::denies('discipline_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $discipline = CourseCategory::find($discipline);
        $discipline->delete();

        return back();
    }

    public function massDestroy(MassDestroyDisciplineRequest $request)
    {
        CourseCategory::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
