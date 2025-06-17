<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Discipline;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCourseRequest;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Institution;
use App\Models\CourseManager;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CoursesController extends Controller {

    use MediaUploadingTrait;

    public function index() {
        abort_if(Gate::denies('course_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $courses = Course::all();
        $inactiveCourses = Course::onlyTrashed()->get();

        return view('admin.courses.index', compact('courses', 'inactiveCourses'));
    }

    public function create() {
        abort_if(Gate::denies('course_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutions = Institution::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $disciplines = Discipline::all()->pluck('name', 'id');
        $course_manager = CourseManager::all();

        return view('admin.courses.create', compact('institutions', 'disciplines', 'course_manager'));
    }

    public function store(StoreCourseRequest $request) {
        $course = Course::create($request->all());
        $course->disciplines()->sync($request->input('disciplines', []));

        $requirements = json_decode($request->input('requirements_json'), true);

// Sample save logic
        foreach ($requirements as $req) {
            $course->requirements()->create([
                'text' => $req['text'],
                'mandatory' => $req['mandatory'],
            ]);
        }

        if ($request->input('photo', false)) {
            $course->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
        }

        return redirect()->route('admin.courses.index');
    }

    public function edit(Course $course) {
        abort_if(Gate::denies('course_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $institutions = Institution::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $disciplines = Discipline::all()->pluck('name', 'id');

        $course->load('institution', 'disciplines', 'course');

        $course_manager = \App\Models\CourseManager::all();

        return view('admin.courses.edit', compact('institutions', 'disciplines', 'course', 'course_manager'));
    }

    public function update(UpdateCourseRequest $request, Course $course) {
        // Validate date logic
        if (strtotime($request->application_end_date) < strtotime($request->application_start_date)) {
            return back()->withErrors(['application_end_date' => 'The application end date must be after the start date.'])->withInput();
        }

        // Update course fields
        $course->update($request->all());

        // Sync disciplines
        $course->disciplines()->sync($request->input('disciplines', []));

        // Update requirements
        $course->requirements()->delete(); // Remove old ones
        
        //dd($request->requirements);

        if ($request->has('requirements')) {
            foreach ($request->input('requirements') as $requirement) {
                if (!empty($requirement['text'])) {
                    $course->requirements()->create([
                        'text' => $requirement['text'],
                        'mandatory' => $requirement['mandatory'],
                    ]);
                }
            }
        }

        return redirect()->route('admin.courses.index')->with('success', 'Course updated successfully.');
    }

    public function show(Course $course) {
        abort_if(Gate::denies('course_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->load('institution', 'disciplines');

        return view('admin.courses.show', compact('course'));
    }

    public function restore($id) {
        $course = Course::withTrashed()->find($id);
        if ($course) {
            $course->restore();
            return redirect()->route('admin.courses.index')->with('success', 'Scholarship restored successfully!');
        }
        return redirect()->route('admin.courses.index')->with('error', 'Scholarship not found!');
    }

    public function destroy(Course $course) {
        abort_if(Gate::denies('course_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $course->delete();

        return back();
    }

    public function massDestroy(MassDestroyCourseRequest $request) {
        Course::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
