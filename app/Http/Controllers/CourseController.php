<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Course;
use App\Models\Institution;
use Auth;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $r)
    {
        $institution = $r->input('institution');
        $inst = Institution::find($institution);
        $courses = Course::searchResults()->paginate(10);
        $breadcrumb = "Courses";
        return view('courses.index', compact(['courses', 'breadcrumb', 'inst']));
    }

    public function show(Course $course)
    {
        $course->load('institution');
        $breadcrumb = $course->name;


        session(['institution_id' => $course->institution->id]);

        //dd($course);

        return view('courses.show', compact(['course', 'breadcrumb']));
    }


    public function restore($id)
    {
        $course = Course::withTrashed()->find($id);
        if ($course) {
            $course->restore();
            return redirect()->route('admin.courses.index')->with('success', 'Scholarship restored successfully!');

        }
        return redirect()->route('admin.courses.index')->with('error', 'Scholarship not found!');
    }


    public function apply(Course $course, Request $r)
    {
        $user_id = auth()->user()->id;
        $course->load('institution');
        $breadcrumb = $course->name;
        $checklist = Checklist::where('application_id', $user_id)->where('scholarship_id', $course->id)->get();
        dd($checklist);

        return view('courses.apply', compact(['course', 'breadcrumb']));
    }
}
