<?php

namespace App\Http\Controllers;

use App\Models\AcademicHistory;
use App\Models\Applications as AppApplications;
use App\Models\Checklist;
use App\Models\Disclaimer;
use App\Models\Employment;
use App\Http\Requests\ChecklistRequest;
use App\Http\Requests\CreateApplicationRequest;
use App\Mail\GeneralMail;
use App\Models\ProfessionalReference;
use App\Models\QualificationAttained;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Traits\InputSanitizerTrait;
use App\Models\ChecklistStudent;
use App\Models\Course;
use App\Traits\HandlesChecklist;
use Illuminate\Support\Facades\Storage;

class ChecklistController extends Controller
{

    use HandlesChecklist;

    public function getChecklist()
    {
        return $this->getChecklistHandler();
    }




    public function storeOrUpdate($checklist, Course $course, Request $request)
    {

        $user_id = auth()->user()->id;
        $scholarship = $request->scholarship_id;
        $course = Course::findOrFail($scholarship);
        $combined = $scholarship . $user_id . '_';

        $checklist = $this->getChecklist();

        $last_id = $checklist::updateOrCreate(
            [
                'application_id' => auth()->user()->id,
                'scholarship_id' => $request->scholarship_id,
                'institution_id' => $course->institution_id,

            ],
            [
                'aof_govt' => $request->aof_govt,
                'aof_ea' => $request->aof_ea,
                'commitment' => $request->commitment,
                'not_beneficiary' => $request->not_beneficiary,
                'completed_application' => $request->completed_application,

            ]
        )->id;


        return redirect()->route('apply.scholarship', [$last_id,$scholarship, 'q=#step-2']);
    }

    function getFileName()
    {
        $file = null;

        // Specify the directory where the files are stored
        $directory = 'your_storage_directory';

        // Get all files in the directory
        $files = Storage::files($directory);

        // Loop through each file to find the one containing "personal_statement"
        foreach ($files as $filePath) {
            if (strpos($filePath, 'personal_statement') !== false) {
                $file = $filePath;
                break;
            }
        }

        // Check if the file was found
        if ($file !== null) {
            // Get the full path of the file
            $fullPath = storage_path('app/' . $file);

            // Now, $fullPath contains the full path to the file
            dd($fullPath);
        } else {
            // File not found
            dd('File not found.');
        }
    }

    function storeApplication(Checklist $checklist, Course $course, Request $request)
    {

        $auth = auth()->user()->id;
        $scholarship = $request->scholarship_id;


        $application = AppApplications::updateOrCreate(
            [
                "checklist" => $checklist->id,
            ],
            [
                'application_id' => $auth,
                'scholarship_id' => $scholarship,
                "application_date" => $request->application_date,
                "first_name" => $request->first_name,
                "surname" => $request->surname,
                "preffered_name" => $request->preffered_name,
                "country" => $request->country,
                "county" => $request->county,
                "town_city" => $request->town_city,
                "affiliated_hospital" => $request->affiliated_hospital,
                "years_worked" => $request->years_worked,
                "preauth_inst_no_of_work_yrs" => $request->preauth_inst_no_of_work_yrs,
                "license_no" => $request->license_no,
                "registration_no" => $request->registration_no,
                "job_group" => $request->job_group,
                "Monthly_salary" => $request->Monthly_salary,
                "phone_no" => $request->phone_no,
                "email_" => $request->email_,
                "gender" => $request->gender,
                "national_id_pass" => $request->national_id_pass,
                "date_of_birth" => $request->date_of_birth,
                "age_years" => $request->age_years,
                "date_to_begin" => $request->date_to_begin,
                "speciality" => $request->speciality,
                "training_institution_with" => $request->training_institution_with,
                "funding_source" => $request->funding_source,
                "funding_source_yes_desc" => $request->funding_source_yes_desc,
                "emergency_first_name" => $request->emergency_first_name,
                "emergency_surname" => $request->emergency_surname,
                "emergency_title" => $request->emergency_title,
                "emergency_first_contact_no" => $request->emergency_first_contact_no,
                "emergency_secondcontact_no" => $request->emergency_secondcontact_no,
                "emergency_email" => $request->emergency_email,
                "emergency_relationship" => $request->emergency_relationship,
                "supervisor_title" => $request->supervisor_title,
                "supervisor_full_name" => $request->supervisor_full_name,
                "supervisor_designation" => $request->supervisor_designation,
                "supervisor_phone_no" => $request->supervisor_phone_no,
                "supervisor_email" => $request->supervisor_email,
                "supervisor_department" => $request->supervisor_department,
                "reference_previous_1" => $request->reference_previous_1,
                "reference_previous_2" => $request->reference_previous_2,
                "reference_previous_3" => $request->reference_previous_3,
            ]
        );

        AcademicHistory::where('checklist', $checklist->id)->delete();
        for ($i = 0; $i < count($request->academic_university); $i++) :
            AcademicHistory::Create(
                [
                    "checklist" => $checklist->id,
                    'application_id' => auth()->user()->id,
                    'scholarship_id' => $request->scholarship_id,
                    'academic_university' => $request->academic_university[$i],
                    'academic_start_date' => $request->academic_start_date[$i],
                    'academic_completion' => $request->academic_completion[$i],
                    'academic_diplomas' => $request->academic_diplomas[$i],
                ]
            );
        endfor;

        QualificationAttained::where('checklist', $checklist->id)->delete();
        for ($i = 0; $i < count($request->training_institution); $i++) :
            QualificationAttained::Create(
                [
                    "checklist" => $checklist->id,
                    'application_id' => auth()->user()->id,
                    'scholarship_id' => $request->scholarship_id,
                    'training_institution' => $request->training_institution[$i],
                    'training_institution_start_date' => $request->training_institution_start_date[$i],
                    'training_institution_completion' => $request->training_institution_completion[$i],
                    'training_institution_attained' => $request->training_institution_attained[$i],
                ]
            );
        endfor;

        ProfessionalReference::where('checklist', $checklist->id)->delete();
        for ($i = 0; $i < count($request->reference_title); $i++) :
            ProfessionalReference::Create(
                [
                    "checklist" => $checklist->id,
                    'application_id' => auth()->user()->id,
                    'scholarship_id' => $request->scholarship_id,
                    'reference_title' => $request->reference_title[$i],
                    'reference_full_name' => $request->reference_full_name[$i],
                    'reference_organization' => $request->reference_organization[$i],
                    'reference_phone_no' => $request->reference_phone_no[$i],
                    'reference_email' => $request->reference_email[$i],
                    'reference_job_title' => $request->reference_job_title[$i],
                ]
            );
        endfor;

        Employment::where('checklist', $checklist->id)->delete();
        for ($i = 0; $i < count($request->previous_organization); $i++) :
            Employment::Create(
                [
                    "checklist" => $checklist->id,
                    'application_id' => auth()->user()->id,
                    'scholarship_id' => $request->scholarship_id,
                    'previous_organization' => $request->previous_organization[$i],
                    'previous_organization_from' => $request->previous_organization_from[$i],
                    'reference_previous_organization_to' => $request->reference_previous_organization_to[$i],
                    'reference_previous_job_title' => $request->reference_previous_job_title[$i],
                    'reference_previous_supervisor' => $request->reference_previous_supervisor[$i],
                    'reference_previous_responsibilities' => $request->reference_previous_responsibilities[$i],
                    'reference_previous_phone_no' => $request->reference_previous_phone_no[$i],
                ]
            );
        endfor;

        return redirect()->route('apply.scholarship', [$checklist->id, $course->id, 'q=#step-4']);
    }

    function storeConsent(Request $request)
    {

        $auth = auth()->user()->id;
        $scholarship = $request->scholarship_id;
        $checklist = $this->getChecklist();
        $checklist_base = $checklist::where('application_id', $auth)->where('scholarship_id', $scholarship)->first();

        $application = Disclaimer::updateOrCreate(
            [
                'application_id' => auth()->user()->id,
                'scholarship_id' => $request->scholarship_id,
            ],
            [
                "checklist" => $checklist_base->id,
                "disclaimer_1" => $request->disclaimer_1,
                "disclaimer_2" => $request->disclaimer_2
            ]
        );

        $application = Disclaimer::where('application_id', auth()->user()->id)->where('scholarship_id', $request->scholarship_id)->get();
        // if ($application) {
        //} else {
        AppApplications::where('application_id', auth()->user()->id)->where('scholarship_id', $request->scholarship_id)->update(['stage' => '25%']);
        //}
        //$this->sendEmail();

        return redirect()->route('enroll.myCourses')->with('success', 'Application submitted successfully!, Please download the bonding form');
    }

    public function sendEmail()
    {
        $email = 'admin@kpfp.com';

        Mail::to($email)->send(new GeneralMail());

        return "Email sent successfully!";
    }
}
