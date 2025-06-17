<?php

namespace App\Http\Controllers;

use App\Models\ApplicantsUploads;
use App\Mail\PreAuthMail;
use App\Mail\EnrollSuccessMail;
use App\Mail\UploadRnBFMail;
use App\Models\AcademicHistory;
use App\Models\Applications;
use App\Models\Checklist;
use App\Models\Course;
use App\Models\Disclaimer;
use App\Models\Employment;
use App\Models\ModeOfPayment;
use \App\Services\ZohoMailService;
use App\Models\PaymentProof;
use App\Models\ProfessionalReference;
use App\Models\QualificationAttained;
use App\Models\User;
use App\Rules\MoreThanOneWord;
use App\Traits\HandlesChecklist;
use App\Models\UploadsManager;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Console\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class EnrollmentController extends Controller {

    use HandlesChecklist;

    public function create() {
        // $breadcrumb = "Enroll in $course->name course";

        return view('enrollment.enroll');
    }

    public function store(Request $request, Course $course) {
        if (auth()->guest()) {
            $request->validate([
                'first_name' => ['required', 'string', 'max:25'],
                'last_name' => ['required', 'string', 'max:25'],
                'id_number' => ['required', 'string', 'max:25', 'unique:users'],
                'email' => 'required|string|email|max:255|unique:users',
                'password' => [
                    'required',
                    'string',
                    'min:8', // Minimum 8 characters
                    'regex:/[A-Za-z]/', // At least one letter
                    'regex:/\d/', // At least one number
                    'regex:/[@$!%*?&]/', // At least one symbol
                    'confirmed', // Match password_confirmation
                ],
                'gender' => 'required|string',
                'county' => 'required|string',
                'phone' => 'required|string|max:20|unique:users',
                'dob' => 'required|date',
                    //'country' => 'required',
                    //'county' => 'sometimes|nullable',
                    ], [
                'password.regex' => 'Password must include at least 8 characters, one letter, one number, and one symbol (@, $, !, %, *, &, etc.).',
                'password.confirmed' => 'Passwords do not match.',
            ]);

            $user = User::create([
                        'first_name' => $request->input('first_name'),
                        'middle_name' => $request->input('middle_name'),
                        'last_name' => $request->input('last_name'),
                        'id_number' => $request->input('id_number'),
                        'email' => $request->input('email'),
                        'password' => Hash::make($request->input('password')),
                        'phone' => $request->input('phone'),
                        'gender' => $request->input('gender'),
                        'dob' => $request->input('dob'),
                        'country' => $request->input('country'),
                        'county' => $request->input('county'),
            ]);

            $user->assignRole('Student');

            $this->sendOtp($user);
            session()->forget('is_submitting');
            return redirect()->route('otp.verification', ['email' => $user->email])->with([
                        'email' => $user->email,
                        'success' => 'Great Progress ' . $user->name . ', Please check your email for Email verification code.'
            ]);

            //auth()->login($user);
        }




        //$course->enrollments()->create(['user_id' => auth()->user()->id]);

        return redirect()->route('enroll.myCourses');
    }

    public function sendOtp(User $user) {
        // Generate a 6-digit OTP
        $otp = mt_rand(100000, 999999);

        // Set expiration time (1 hour from now)
        $expiryTime = Carbon::now()->addHour();

        // Update user record with OTP and expiration
        $user->update([
            'otp' => $otp,
            'otp_expires_at' => $expiryTime,
        ]);

        // Send OTP via email
        $zoho = app(ZohoMailService::class);
        $result = $zoho->sendMailable($user->email, new \App\Mail\OtpMail($user, $otp));
    }

    public function verifyOtp(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|digits:6',
        ]);

        $user = User::where('email', $request->email)->first();

        // Validate OTP and expiration
        if ($user->otp === $request->otp && Carbon::now()->lessThanOrEqualTo($user->otp_expires_at)) {
            // Mark the user as verified
            $user->update([
                'is_verified' => 'true',
                'otp' => null, // Clear OTP after verification
                'otp_expires_at' => null,
            ]);

            auth()->login($user);

            // $region = $this->checkUserCountry($user);
            //session(['region' => $region]);

            return redirect()->route('post.login')->with('success', 'Welcome back, ' . $user->name . '!');
        }

        return redirect()->route('otp.verification', ['email' => $user->email])->with('error', 'Invalid or expired OTP. Please enter a valid OTP.');
    }

    public function verify_otp() {

        return view('enrollment.otp-verify');
    }

    public function postLogin() {
        $user = auth()->user();
        $institution = \App\Models\Institution::find(session('institution_id'));
        $course = \App\Models\Course::find(session('course_id'));

        if (is_null($institution)) {
            return redirect()->route('home')->with('success', 'Welcome ' . $user->first_name . ', Your registration is successfull!');
        } else {
            return view('enrollment.confirmation', compact(['user', 'institution', 'course']));
        }
    }

    public function handleLogin(Course $course) {

        return redirect()->route('enroll.create', $course->id);
    }

    public function myCourses() {
        $breadcrumb = "MY SCHOLARSHIP APPLICATIONS";
        $user_id = auth()->user()->id;
        $checklist = $this->getChecklistHandler();
        $enrollments = $checklist::where('application_id', $user_id)->with(['application', 'institution'])->orderBy('id', 'desc')->get();

        // return $enrollments;

        return view('enrollment.courses', compact(['breadcrumb', 'enrollments']));
    }

    function getall() {
        $application = Checklist::with(['application', 'academicHistory', 'qualificationAttained', 'professionalReference', 'employment', 'disclaimer', 'institution'])->get();
        return $application;
    }

    public function proof_of_payment(Applications $scholarship, Course $course) {
        $user_id = auth()->user()->id;
        $payment_details = ModeOfPayment::where('institution_id', $course->institution_id)->get();
        if ($payment_details->count() < 1) {
            return back()->with(['error' => 'Sorry, Organization has not set mode of payment yet. Try again later']);
        }
        return view('courses.proof_of_payment', compact('course', 'user_id', 'payment_details', 'scholarship'));
    }

    public function apply($checklist_id = 0, Course $course, Request $r) {

        //dd($course);


        $step = request('q');
        $user_id = auth()->user()->id;
        $applicant = User::find($user_id);
        $documents = UploadsManager::all();
        $uploaded_documents = ApplicantsUploads::where('student_id', $user_id)->where('course_id', $course->id)->where('institution_id', $course->institution_id)->get();

        // Calculate progress
        $totalDocuments = 4; // denominator
        $uploadedCount = $uploaded_documents->count(); // numerator
        //dd($uploaded_documents);
        $progress = $totalDocuments > 0 ? ($uploadedCount / $totalDocuments) * 100 : 0;

        if ($checklist_id != 0) {

            $checklist = Checklist::with(['application', 'academicHistory', 'qualificationAttained', 'professionalReference', 'employment', 'disclaimer'])
                    ->where('id', $checklist_id)
                    ->get();
        } else {
            $checklist = Checklist::where('application_id', $user_id)->where('scholarship_id', $course->id)->where('institution_id', $course->institution_id)->get();
        }

        $course->load('institution');
        $breadcrumb = $course->name;

        $application = [0 => $checklist[0]['application'] ?? []];
        $academic_history = $checklist[0]['academicHistory'] ?? [];
        $qualification_attained = $checklist[0]['qualificationAttained'] ?? [];
        $professional_reference = $checklist[0]['professionalReference'] ?? [];
        $employment = $checklist[0]['employment'] ?? [];
        $disclaimer = [0 => $checklist[0]['disclaimer'] ?? []];

        return view('courses.apply', compact(['course', 'uploaded_documents', 'breadcrumb', 'checklist', 'step', 'application', 'academic_history', 'qualification_attained', 'professional_reference', 'employment', 'disclaimer', 'documents', 'progress', 'applicant']));
    }

    public function upload($checklist_id = 0, Course $course, Request $request) {
        $request->validate([
            'document' => 'required|mimes:pdf,jpg,jpeg,png|max:5120',
            'document_id' => 'required|exists:uploads_managers,id',
        ]);

        $student = auth()->user();
        $document = UploadsManager::findOrFail($request->document_id);
        // $course = Course::findOrFail($course_id);
        // Get previous uploads for this document
        $previousUpload = ApplicantsUploads::where('student_id', $student->id)
                ->where('document_id', $document->id)
                ->where('course_id', $course->id)
                ->orderBy('version', 'desc')
                ->first();

        // Determine new version number
        $newVersion = $previousUpload ? $previousUpload->version + 1 : 1;

        // Get original file name and extension
        $originalName = pathinfo($request->file('document')->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $request->file('document')->getClientOriginalExtension();

        // Sanitize file name (Replace spaces & special characters with underscores)
        $sanitizedFileName = preg_replace('/[^A-Za-z0-9]/', '_', $originalName);
        $fileName = "{$student->id}_{$student->first_name}_{$student->last_name}_{$document->slug}_{$request->document_id}_v{$newVersion}.{$extension}";

        // Store the file
        $filePath = $request->file('document')->storeAs("files/personal_documents/{$course->institution_id}/{$course->id}/{$student->id}_{$student->first_name}_{$student->last_name}", $fileName, 'public');

        // Save file reference with versioning
        ApplicantsUploads::create([
            'student_id' => $student->id,
            'document_id' => $document->id,
            'institution_id' => $course->institution_id,
            'course_id' => $course->id,
            'file_path' => $filePath,
            'version' => $newVersion, // Add a version column in your DB
        ]);

        return redirect()->route('apply.scholarship', [$checklist_id, $course->id, 'q=#step-2'])->with('success', $originalName . ' Document uploaded successfully!');
    }

    public function upload_other(Applications $scholarship, Course $course, Request $request) {

        $request->validate([
            'document' => 'required|mimes:pdf,zip,xlsx,docx,doc,xls|max:5120',
            'document_id' => 'required|exists:uploads_managers,id',
        ]);

        $student = User::find($scholarship->application_id);
        $document = UploadsManager::findOrFail($request->document_id);
        // $course = Course::findOrFail($course_id);
        // Get previous uploads for this document
        $previousUpload = ApplicantsUploads::where('student_id', $student->id)
                ->where('document_id', $document->id)
                ->where('course_id', $course->id)
                ->orderBy('version', 'desc')
                ->first();

        // Determine new version number
        $newVersion = $previousUpload ? $previousUpload->version + 1 : 1;

        // Get original file name and extension
        $originalName = pathinfo($request->file('document')->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $request->file('document')->getClientOriginalExtension();

        // Sanitize file name (Replace spaces & special characters with underscores)
        $sanitizedFileName = preg_replace('/[^A-Za-z0-9]/', '_', $originalName);
        $fileName = "{$student->id}_{$student->full_name}_{$document->slug}_{$request->document_id}_v{$newVersion}.{$extension}";

        // Store the file
        $filePath = $request->file('document')->storeAs("files/personal_documents/{$course->institution_id}/{$course->id}/{$student->id}_{$student->full_name}", $fileName, 'public');

        // Save file reference with versioning
        $last_id = ApplicantsUploads::create([
                    'student_id' => $student->id,
                    'document_id' => $document->id,
                    'institution_id' => $course->institution_id,
                    'course_id' => $course->id,
                    'file_path' => $filePath,
                    'version' => $newVersion, // Add a version column in your DB
                ])->id;

        if ($request->document_id == 14) {

            $scholarship->update([
                'proof_of_payment' => $last_id,
                'stage' => '50%'
            ]);

            $zoho = app(ZohoMailService::class);
            $result = $zoho->sendMailable($student->email, new \App\Mail\ProofOfPaymentMail($student));
        } elseif ($request->document_id == 15) {


            $scholarship->update([
                'authorized_form' => $last_id,
                'stage' => '50%'
            ]);
            $zoho = app(ZohoMailService::class);
            $result = $zoho->sendMailable($student->email, new \App\Mail\UploadPreAuthMail($student, $course));

            return redirect()->route('enroll.myCourses')->with('success', $originalName . ' Uploaded Successfully. Please check email for next steps');
        } elseif ($request->document_id == 16) {

            $scholarship->update([
                'bonding_form' => $last_id,
                'stage' => '100%',
                'status' => 'Selected'
            ]);
            // Mail::to($student->email)->send(new EnrollSuccessMail($student, $course));
            $zoho = app(ZohoMailService::class);
            $result = $zoho->sendMailable($student->email, new EnrollSuccessMail($student, $course));
            return redirect()->route('admin.home')->with('success', $originalName . ' Document uploaded successfully!');
        } elseif ($request->document_id == 17) {

            $scholarship->update([
                'release_and_bonding_form' => $last_id
            ]);
            $zoho = app(ZohoMailService::class);
            $result = $zoho->sendMailable($student->email, new UploadRnBFMail($student, $course));

            return redirect()->route('enroll.myCourses')->with('success', $originalName . ' Release & Bonding uploaded successfully!');
        }



        return redirect()->route('enroll.myCourses')->with('success', $originalName . ' Document uploaded successfully!');
    }

    public function uploadProofOfPayment(Request $request, $scholarship, $user_id) {

        $combined = $scholarship . $user_id . '_';

        $request->validate([
            'pdf_file' => 'required|mimes:pdf,jpeg,png,jpg|max:2048', // PDF file, max size 2MB
        ]);

        $file = $request->file('pdf_file');
        $fileName = $combined . date('Y_m_d') . '_proof_of_payments_' . $this->sanitizeInput(auth()->user()->name) . '.' . $file->getClientOriginalExtension();

        if (Storage::exists('files/proof_of_payments/' . $fileName)) {
            Storage::delete('files/proof_of_payments/' . $fileName);
            // File was deleted successfully
        }

        $file->storeAs('public/files/proof_of_payments/', $fileName);

        $last_id = PaymentProof::updateOrCreate(
                        [
                            'application_id' => $user_id,
                            'scholarship_id' => $scholarship,
                        ],
                        [
                            'link' => 'files/proof_of_payments/' . $fileName,
                            'proof' => '1'
                        ]
        );

        return redirect()->route('enroll.myCourses')->with('success', 'Proof of payment has been successfully uploaded.');
    }

    public function completedApplication() {
        return view('courses.completed');
    }

    public function getForm(Applications $scholarship, Course $course) {
        return view('courses.upload', compact('scholarship', 'course'));
    }

    public function uploadBondingForm(Applications $scholarship, Course $course) {
        return view('courses.upload_bonding', compact('scholarship', 'course'));
    }

    public function sendEmail() {
        $email = 'trainingschool@gerties.org';

        Mail::to($email)->send(new PreAuthMail());

        return "Email sent successfully!";
    }

    public function uploadForm(Applications $scholarship, Course $course, Request $request) {

        $user = auth()->user();

        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:2048', // PDF file, max size 2MB
        ]);

        $file = $request->file('pdf_file');

        $fileName = date('Y_m_d') . '_pre_auth_form_' . $user->first_name . '_' . $user->last_name . '.' . $file->getClientOriginalExtension();

        $filePath = $file->storeAs("files/pre_auth_forms/{$course->institution_id}/{$course->id}/{$scholarship->application_id}_{$user->first_name}_{$user->last_name}", $fileName, 'public');
        $scholarship->update([
            'authorized_form' => $filePath,
            'stage' => '50%'
        ]);

        //$this->sendEmail();

        return redirect()->route('enroll.myCourses')->with('success', 'Pre-auth file uploaded successfully!');
    }

    public function uploadBonding(Request $request, $id) {


        $request->validate([
            'pdf_file' => 'required|mimes:zip|max:2048', // PDF file, max size 2MB
        ]);

        $file = $request->file('pdf_file');
        $fileName = $id . '_' . date('Y_m_d') . '_bonding_form_' . $this->sanitizeInput(auth()->user()->name) . '.' . $file->getClientOriginalExtension();

        $file->storeAs('public/files/bonding_forms', $fileName);

        $last_id = Applications::where('id', $id)->update(
                [
                    'bonding_form' => 'files/bonding_forms/' . $fileName,
                    'stage' => '100%'
                ]
        );

        //$this->sendEmail();

        return redirect()->back()->with('success', 'Bonding form  uploaded successfully!');
    }

    public function generatePdf($checklist_id, Course $course) {
        $checklist = Checklist::with(['application', 'academicHistory', 'qualificationAttained', 'professionalReference', 'employment', 'disclaimer'])
                ->where('id', $checklist_id)
                ->get();

        $uploaded_documents = ApplicantsUploads::where('student_id', auth()->user()->id)->where('course_id', $course->id)->where('institution_id', $course->institution_id)->get();

        $application = [0 => $checklist[0]['application']];
        $academic_history = $checklist[0]['academicHistory'];
        $qualification_attained = $checklist[0]['qualificationAttained'];
        $professional_reference = $checklist[0]['professionalReference'];
        $employment = $checklist[0]['employment'];
        $disclaimer = [0 => $checklist[0]['disclaimer']];

        // Pass the variables to the view
        $data = compact('checklist', 'application', 'academic_history', 'qualification_attained', 'professional_reference', 'employment', 'disclaimer', 'uploaded_documents');

        // Load the PDF view
        //$imagePath = public_path('img/kpfpheader.png');



        $pdf = SnappyPdf::loadView('courses.view', $data);

        $pdf->setOption('images', true);
        $pdf->setOption('image-quality', 100);
        $pdf->setOption('no-images', false);
        $pdf->setPaper('a4')->setOrientation('portrait')->setOption('margin-left', 5)->setOption('margin-right', 10);

        // Download the PDF
        return $pdf->download($checklist_id . '_' . auth()->user()->first_name . '_' . auth()->user()->last_name . '_scholarship_application.pdf');
    }

    public function show($course, $user_id) {
        $checklist = Checklist::where('application_id', $user_id)->where('scholarship_id', $course)->get();
        $application = Applications::where('application_id', $user_id)->where('scholarship_id', $course)->get();
        $academic_history = AcademicHistory::where('application_id', $user_id)->where('scholarship_id', $course)->get();

        $qualification_attained = QualificationAttained::where('application_id', $user_id)->where('scholarship_id', $course)->get();
        $professional_reference = ProfessionalReference::where('application_id', $user_id)->where('scholarship_id', $course)->get();
        $employment = Employment::where('application_id', $user_id)->where('scholarship_id', $course)->get();
        $disclaimer = Disclaimer::where('application_id', $user_id)->where('scholarship_id', $course)->get();

        return view('courses.view', compact(['checklist', 'application', 'academic_history', 'qualification_attained', 'professional_reference', 'employment', 'disclaimer']));
    }

    public function sanitizeInput($input) {
        // Remove HTML tags and encode special characters
        $sanitizedInput = filter_var($input, FILTER_SANITIZE_STRING);

        // Replace special characters with underscores
        $sanitizedInput = str_replace([' ', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '+', '=', '{', '}', '[', ']', '|', ';', ':', ',', '<', '>', '?', '/', '\\', "'", '"', '`', '~'], '_', $sanitizedInput);

        // Remove consecutive underscores
        $sanitizedInput = preg_replace('/_+/', '_', $sanitizedInput);

        // Trim underscores from the beginning and end
        $sanitizedInput = trim($sanitizedInput, '_');

        return $sanitizedInput;
    }
}
