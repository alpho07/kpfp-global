<?php

namespace App\Http\Controllers;

use App\Services\ZohoMailService;
use App\ApplicantsUploads;
use App\Models\Course;
use App\Models\Institution;
use App\Models\UploadsManager;

class HomeController extends Controller {

    public function index() {
       
        $newestCourses = []; // Course::orderBy('id', 'desc')->take(3)->get();
        $randomInstitutions = Institution::with('courses')->whereNotIn('id', [3])->get();

        return view('home', compact(['newestCourses', 'randomInstitutions']));
    }
    
    function maintenance(){
        echo '<b> 404 - Site Under Maintenance! </b>';
    }

    public function sendEmail() {

        $zoho = app(ZohoMailService::class);
        $result = $zoho->sendMailable('alpho07@gmail.com', new \App\Mail\VerifiedMail('Jaherena'));
    
        return response()->json($result);
    }
}
