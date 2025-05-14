<?php

namespace App\Http\Controllers\Admin;

use App\Models\Applications;
use App\Models\Checklist;
use App\Models\Course;
use App\Models\Enrollment;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEnrollmentRequest;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Requests\UpdateEnrollmentRequest;
use App\Mail\BondingFormMail;
use App\Mail\VerifiedMail;
use App\Mail\QueryMail;
use App\Mail\RejectedMail;
use App\Mail\ApprovedMail;
use App\Mail\ApplicationSuccessMail;
use App\Models\User;
use \App\Services\ZohoMailService;
use Gate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class EnrollmentsController extends Controller {

    public function index(Request $request) {

        $user = auth()->user();
        $role = $user->roles()->pluck('name')->toArray();

        if (in_array('Student', $role)) {
            return redirect()->route('enroll.myCourses');
        } elseif (in_array('Super Admin', $role)) {
            //return redirect()->route('admin.enrollments.index');
        } elseif (in_array('Admin', $role)) {
            abort_if(Gate::denies('enrollment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        } else if (in_array('User Manager', $role)) {
            return redirect()->route('admin.users.index');
        } elseif (in_array('Application Manager', $role)) {
            // return redirect()->route('admin.enrollments.index');
        } elseif (in_array('Course Manager', $role)) {
            return redirect()->route('admin.courses.index');
        } elseif (in_array('Finance Manager', $role)) {
            abort_if(Gate::denies('enrollment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }


        $query = Checklist::with(['application', 'academicHistory', 'qualificationAttained', 'professionalReference', 'employment', 'disclaimer']);

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
        $county = $request->input('county');
        $town_city = $request->input('town_city');
        $affiliated_hospital = $request->input('affiliated_hospital');
        $gender = $request->input('gender');
        $authorized_form = $request->input('authorized_form');
        $verification_status = $request->input('verification_status');
        $short_listing_status = $request->input('status');
        $stage = $request->input('stage');
        $payment_verified = $request->input('payment_verified');
        $course_id = $request->input('scholarship_id');
        $institution_id = $request->input('institution_id');

        $searchFilters = ['start_date', 'end_date', 'county', 'scholarship_id', 'institution_id', 'town_city', 'affiliated_hospital', 'gender', 'authorized_form', 'verification_status', 'status', 'stage', 'payment_verified'];

        foreach ($searchFilters as $filter) {
            if ($request->filled($filter)) {
                if ($filter === 'scholarship_id' || $filter === 'institution_id') {
                    // Apply exact match directly on Checklist table
                    $query->where($filter, $request->input($filter));
                } else {
                    // Apply other filters on the application relationship
                    $query->whereHas('application', function ($q) use ($request, $filter) {
                        if ($filter === 'start_date' || $filter === 'end_date') {
                            if ($request->filled('start_date') && !$request->filled('end_date')) {
                                $startDate = $request->input('start_date');
                                $q->whereRaw("DATE_FORMAT(created_at, '%Y-%m') = ?", [$startDate]);
                            } elseif ($request->filled('start_date') && $request->filled('end_date')) {
                                $startDate = $request->input('start_date');
                                $endDate = $request->input('end_date');
                                $q->whereBetween('created_at', [$startDate, $endDate]);
                            }
                        } else {
                            $q->where($filter, 'like', '%' . $request->input($filter) . '%');
                        }
                    });
                }
            }
        }


        $enrollments = $query->get();
        // dd($query->toSql());


        return view('admin.enrollments.index', compact('enrollments', 'start_date', 'end_date', 'county', 'town_city', 'affiliated_hospital', 'gender', 'authorized_form', 'verification_status', 'short_listing_status', 'stage', 'payment_verified'));
    }

    public function updateStatus(Applications $application_id, Request $request) {
        $user = User::find($application_id->application_id);
        $checklist = Checklist::with('course')->find($application_id->checklist);

        $data = [
            'status' => $request->status
        ];

        if ($request->has('comments')) {
            $data['comments'] = $request->comments;
        }

        $application_id->update($data);

        if ($request->status == 'Approved') {
            //Mail::to($user->email)->send(new ApprovedMail($user, $checklist));
            $zoho = app(ZohoMailService::class);
            $result = $zoho->sendMailable($user->email, new ApprovedMail($user, $checklist));
        }


        return response()->json(['message' => 'Status updated successfully']);
    }

    public function updateStatusForm(Applications $application_id, Request $request) {
        $user = User::find($application_id->application_id);
        $checklist = Checklist::with('course')->find($application_id->checklist);

        $data = [
            'status' => $request->status
        ];

        if ($request->has('comments')) {
            $data['comments'] = $request->comments;
        }

        $application_id->update($data);

        if ($request->status == 'Query') {
            //Mail::to($user->email)->send(new QueryMail($user, $checklist, $request->comments));
            $zoho = app(ZohoMailService::class);
            $result = $zoho->sendMailable($user->email, new QueryMail($user, $checklist, $request->comments));
        }

        if ($request->status == 'Rejected') {
            //Mail::to($user->email)->send(new RejectedMail($user, $checklist, $request->comments));
            $zoho = app(ZohoMailService::class);
            $result = $zoho->sendMailable($user->email, new RejectedMail($user, $checklist, $request->comments));
        }


        return redirect()->back()->with('success', 'Status updated successfully');
    }

    function loadPeriod() {
        
    }

    public function manageFiles() {
        $url = url('files');
        return view('admin.enrollments.files', compact('url'));
    }

    public function verifyApplication($course, $user_id) {

        $application = Applications::updateOrCreate(
                        [
                            'application_id' => $user_id,
                            'scholarship_id' => $course,
                        ],
                        [
                            "verification_status" => 'Verified',
                            "stage" => '75%'
                        ]
        );

        $this->sendEmail();

        return redirect()->back()->with('success', 'Scholarship Application Successfully Verified');
    }

    public function undoverifyApplication($course, $user_id) {

        $application = Applications::updateOrCreate(
                        [
                            'application_id' => $user_id,
                            'scholarship_id' => $course,
                        ],
                        [
                            "verification_status" => 'Not Verified',
                        ]
        );

        // $this->sendEmail();

        return redirect()->back()->with('success', 'Scholarship Application Undo verification successfully');
    }

    public function sendEmail() {
        $user = auth()->user(); // or fetch from DB      
        $course = 'Community Health Nursing';

        Mail::to($user->email)->send(new ApplicationSuccessMail());

        return "Email sent successfully!";
    }

    public function sendBondingEmail($user) {

        Mail::to($user->email_)->send(new BondingFormMail());

        return "Email sent successfully!";
    }

    public function sendShortListings(Request $r) {
        foreach ($r->ids as $id) :
            $user = Applications::find($id);
            $this->sendBondingEmail($user);
            Applications::where('id', $id)->update([
                'short_listing_status' => 'Shortlisted',
                'short_listed_by' => auth()->user()->name,
                'bonding_form' => 'Sent',
                'stage' => '70%'
            ]);
        endforeach;
    }

    public function sendPaymentVerification(Request $r) {
        foreach ($r->ids as $id) :
            $user = Applications::find($id);
            ///$this->sendBondingEmail($user);
            Applications::where('id', $id)->update([
                'payment_verified' => 'Yes',
            ]);
        endforeach;
    }

    public function create() {
        abort_if(Gate::denies('enrollment_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courses = Course::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.enrollments.create', compact('users', 'courses'));
    }

    public function store(StoreEnrollmentRequest $request) {
        $enrollment = Enrollment::create($request->all());

        return redirect()->route('admin.enrollments.index');
    }

    public function edit(Enrollment $enrollment) {
        abort_if(Gate::denies('enrollment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $courses = Course::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $enrollment->load('user', 'course');

        return view('admin.enrollments.edit', compact('users', 'courses', 'enrollment'));
    }

    public function update(UpdateEnrollmentRequest $request, Enrollment $enrollment) {
        $enrollment->update($request->all());

        return redirect()->route('admin.enrollments.index');
    }

    public function show(Enrollment $enrollment) {
        abort_if(Gate::denies('enrollment_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enrollment->load('user', 'course');

        return view('admin.enrollments.show', compact('enrollment'));
    }

    public function destroy(Enrollment $enrollment) {
        abort_if(Gate::denies('enrollment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $enrollment->delete();

        return back();
    }

    public function massDestroy(MassDestroyEnrollmentRequest $request) {
        Enrollment::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
