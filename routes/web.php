<?php

use App\Http\Controllers\HomeController as DefaulHomeController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\MessagingController;
use App\Http\Controllers\Admin\EnrollmentsController as AdminEnrollmentsController;
use App\Http\Controllers\Admin\PermissionsController as AdminPermissionsController;
use App\Http\Controllers\Admin\RolesController as AdminRolesController;
use App\Http\Controllers\Admin\DisciplinesController as AdminDisciplinesController;
use App\Http\Controllers\Admin\InstitutionsController as AdminInstitutionsController;
use App\Http\Controllers\Admin\CoursesController as AdminCoursesController;
use App\Http\Controllers\Admin\DocumentManagerController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ModeOfPayment;
use App\Http\Controllers\Admin\ModeOfPaymentController;
use App\Http\Controllers\Admin\UsersController;
use Barryvdh\Elfinder\Elfinder;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CourseManagerController as AdminCourseManagerController;
use App\Http\Controllers\Admin\PeriodController as AdminPeriodController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use League\Glide\ServerFactory;

Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::get('/send-mail', [DefaulHomeController::class, 'sendEmail'])->name('email.send');

Route::get('/', [DefaulHomeController::class, 'index'])->name('home');

// Enrollment routes
Route::get('enroll/login', [EnrollmentController::class, 'handleLogin'])
        ->name('enroll.handleLogin')
        ->middleware('auth');

Route::get('enroll', [EnrollmentController::class, 'create'])->name('enroll.create');
Route::post('enroll', [EnrollmentController::class, 'store'])->name('enroll.store');

Route::get('my-scholarships-applications', [EnrollmentController::class, 'myCourses'])
        ->name('enroll.myCourses')
        ->middleware('auth');

// Course routes
Route::resource('courses', CourseController::class)->only(['index', 'show']);

Route::get('apply/{checklist?}/{course?}', [EnrollmentController::class, 'apply'])
        ->name('apply.scholarship')
        ->middleware('auth');

// Checklist routes
Route::post('save-checklist/{checklist?}/{course}', [ChecklistController::class, 'storeOrUpdate'])
        ->name('save.checklist')
        ->middleware('auth');

Route::post('save.application/{checklist?}/{course?}', [ChecklistController::class, 'storeApplication'])
        ->name('save.application')
        ->middleware('auth');

Route::post('save.disclaimer/{checklist}/{course}', [ChecklistController::class, 'storeConsent'])
        ->name('save.disclaimer')
        ->middleware('auth');

// Enrollment process routes
Route::get('application-success', [EnrollmentController::class, 'completedApplication'])
        ->name('application.success')
        ->middleware('auth');

Route::get('upload-pre-auth-form/{scholarship}/{course}', [EnrollmentController::class, 'getForm'])
        ->name('pre.auth.upload')
        ->middleware('auth');

Route::post('save-pre-auth-form/{scholarship}/{course}', [EnrollmentController::class, 'upload_other'])
        ->name('pre.auth.save')
        ->middleware('auth');

Route::post('save-proof-auth-form/{scholarship}/{course}', [EnrollmentController::class, 'uploadProofOfPayment'])
        ->name('proof.auth.save')
        ->middleware('auth');

Route::get('view/{course}/{user_id}', [EnrollmentController::class, 'show'])
        ->name('application.show')
        ->middleware('auth');

Route::get('download/{checklist}/{course}', [EnrollmentController::class, 'generatePdf'])
        ->name('application.download')
        ->middleware('auth');

Route::post('upload-bonding-save/{id}', [EnrollmentController::class, 'uploadBonding'])
        ->name('bonding.form.save')
        ->middleware('auth');

Route::get('upload-bonding-form/{id}', [EnrollmentController::class, 'uploadBondingForm'])
        ->name('bonding.form.upload')
        ->middleware('auth');



Route::get('upload-bonding-form/{scholarship}/{course}', [EnrollmentController::class, 'uploadBondingForm'])
        ->name('bonding.form.upload')
        ->middleware('auth');

Route::get('get_all', [EnrollmentController::class, 'getall'])
        ->name('get.all')
        ->middleware('auth');

// Messaging routes
Route::get('messaging-inbox/{sender}/{receiver}', [MessagingController::class, 'index_inbox'])
        ->name('messaging.inbox');

Route::get('messaging/{sender}/{receiver}', [MessagingController::class, 'index'])
        ->name('messaging.index');

Route::post('messaging/{sender}/{receiver}', [MessagingController::class, 'store'])
        ->name('messaging.save');

// Proof of payment
Route::get('proof-of-payment/{scholarship?}/{course?}', [EnrollmentController::class, 'proof_of_payment'])
        ->name('proof.auth.load')
        ->middleware('auth');

Route::get('step-three/{checklist?}/{course?}', function ($checklist, $course) {
    return redirect()->route('apply.scholarship', [$checklist, $course, 'q=#step-3']);
})->name('step.three');

Route::post('/document-upload/{checklist?}/{course?}', [EnrollmentController::class, 'upload'])->name('student.documents.upload')->middleware('auth');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    //'namespace' => 'Admin',
    'middleware' => ['auth']
        ], function () {

            // Admin Home
            Route::get('/', [AdminEnrollmentsController::class, 'index'])->name('home');

            Route::get('/document-manager', [DocumentManagerController::class, 'index'])->name('document.manager');
            Route::post('/application-update-status/{application_id}', [AdminEnrollmentsController::class, 'updateStatus'])->name('application.update.status');
            Route::post('/application-update-status-form/{application_id}', [AdminEnrollmentsController::class, 'updateStatusForm'])->name('application.update.status.form');

            // File Manager
            Route::get('file-manager', [AdminEnrollmentsController::class, 'manageFiles'])
                    ->name('file.manager')
                    ->middleware('auth');

            // Permissions
            Route::delete('permissions/destroy', [AdminPermissionsController::class, 'massDestroy'])
                    ->name('permissions.massDestroy');
            Route::resource('permissions', AdminPermissionsController::class);

            // Applications
            Route::post('verify/{course}/{user_id}', [AdminEnrollmentsController::class, 'verifyApplication'])
                    ->name('application.verify')
                    ->middleware('auth');
            Route::get('undo-verify/{course}/{user_id}', [AdminEnrollmentsController::class, 'undoverifyApplication'])
                    ->name('undo.verify')
                    ->middleware('auth');
            Route::post('send-bonding', [AdminEnrollmentsController::class, 'sendShortListings'])
                    ->name('send.bonding.form')
                    ->middleware('auth');
            Route::post('send-verification', [AdminEnrollmentsController::class, 'sendPaymentVerification'])
                    ->name('send.verification.form')
                    ->middleware('auth');
            Route::get('download_files/{prefix}', [AdminHomeController::class, 'zipAndDownloadFiles'])
                    ->name('application.files')
                    ->middleware('auth');

            // Roles
            Route::delete('roles/destroy', [AdminRolesController::class, 'massDestroy'])
                    ->name('roles.massDestroy');
            Route::resource('roles', AdminRolesController::class);

            Route::resource('mode-of-payment', ModeOfPaymentController::class);

            // Users
            Route::delete('users/destroy', [UsersController::class, 'massDestroy'])
                    ->name('users.massDestroy');
            Route::resource('users', UsersController::class);

            // Disciplines
            Route::delete('disciplines/destroy', [AdminDisciplinesController::class, 'massDestroy'])
                    ->name('disciplines.massDestroy');
            Route::resource('disciplines', AdminDisciplinesController::class);

            // Institutions
            Route::delete('institutions/destroy', [AdminInstitutionsController::class, 'massDestroy'])
                    ->name('institutions.massDestroy');
            Route::post('institutions/media', [AdminInstitutionsController::class, 'storeMedia'])
                    ->name('institutions.storeMedia');
            Route::resource('institutions', AdminInstitutionsController::class);

            Route::get('institutions/{id}/restore', [AdminInstitutionsController::class, 'restore'])
                    ->name('institutions.restore');

            // Courses
            Route::delete('courses/destroy', [AdminCoursesController::class, 'massDestroy'])
                    ->name('courses.massDestroy');
            Route::post('courses/media', [AdminCoursesController::class, 'storeMedia'])
                    ->name('courses.storeMedia');
            Route::resource('courses', AdminCoursesController::class);
            Route::get('courses/{id}/restore', [AdminCoursesController::class, 'restore'])
                    ->name('courses.restore');

            // Course Category
            Route::delete('course-category/destroy', [AdminCategoryController::class, 'massDestroy'])->name('course.categories.massDestroy');
            Route::resource('course-category', AdminCategoryController::class);

            // Course Manager
            Route::delete('course-manager/destroy', [AdminCourseManagerController::class, 'massDestroy'])->name('course.manager.massDestroy');
            Route::resource('course-manager', AdminCourseManagerController::class);

            // Periods
            Route::delete('course-period/destroy', [AdminPeriodController::class,'massDestroy'])->name('months.massDestroy');
            Route::resource('course-period', AdminPeriodController::class);

            // Enrollments
            Route::delete('enrollments/destroy', [AdminEnrollmentsController::class, 'massDestroy'])
                    ->name('enrollments.massDestroy');
            Route::resource('enrollments', AdminEnrollmentsController::class);
        });

Route::get('/file/{dir1}/{$dir2}/{$dir3}/{$filename}', function ($dir1, $dir2, $dir3, $filename) {
    return Storage::download($dir1 . '/' . $dir2 . '/' . $dir3 . '/' . $filename);
});

Route::get('glide/{path}', function ($path) {
    $server = ServerFactory::create([
                'source' => app('filesystem')->disk('public')->getDriver(),
                'cache' => storage_path('glide'),
    ]);
    return $server->getImageResponse($path, Input::query());
})->where('path', '.+');

use Barryvdh\Elfinder\ElfinderController;

Route::group(['prefix' => 'elfinder', 'middleware' => ['web', 'auth']], function () {
    Route::get('index', [ElfinderController::class, 'showIndex'])->name('elfinder.index');
    Route::any('connector', [ElfinderController::class, 'showConnector'])->name('elfinder.connector');
    Route::get('popup/{input_id}', [ElfinderController::class, 'showPopup'])->name('elfinder.popup');
    Route::get('tinymce', [ElfinderController::class, 'showTinyMCE'])->name('elfinder.tinymce');
    Route::get('tinymce4', [ElfinderController::class, 'showTinyMCE4'])->name('elfinder.tinymce4');
    Route::get('tinymce5', [ElfinderController::class, 'showTinyMCE5'])->name('elfinder.tinymce5');
    Route::get('ckeditor', [ElfinderController::class, 'showCKeditor4'])->name('elfinder.ckeditor');
});

Route::get('/php-version', function () {
    return 'PHP Version: ' . phpversion();
});
