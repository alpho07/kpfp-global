<?php

namespace App\Http\Controllers;

use App\ApplicantsUploads;
use App\Models\Course;
use App\Models\Institution;
use App\Models\UploadsManager;

class HomeController extends Controller
{
    public function index()
    {
        $newestCourses = Course::orderBy('id', 'desc')->take(3)->get();
        $randomInstitutions = Institution::whereNotIn('id', [8])->get();

        return view('home', compact(['newestCourses', 'randomInstitutions']));
    }

  
}
