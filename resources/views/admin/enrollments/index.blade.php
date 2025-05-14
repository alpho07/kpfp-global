@extends('layouts.admin')
@section('content')
<style>
    #loader-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        display: none;
        text-align: center;
    }

    #loader {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
        border-top: 16px solid blue;
        border-bottom: 16px solid blue;
    }

    #loading-message {
        margin-top: 10px;
        font-size: 16px;
        color: #333;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    table {
        font-size: 11px;
    }
</style>





@can('enrollment_create')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    </div>
</div>
@endcan

<div class="row">
    <div class="col-12 mt-0 mb-1">
        <h4 class="text-uppercase">Filter</h4>
    </div>
</div>
<div class="card" style="padding: 10px;">
    <form action="{{ url('admin/enrollments') }}" method="GET">
        <div class="row mb-2">
            <div class="col-md-3">
                <input type="text" class="form-control datepicker" name="start_date" placeholder="Start Date"
                       value="{{ old('start_date', request('start_date')) }}">
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control datepicker" name="end_date" placeholder="End Date"
                       value="{{ old('start_date', request('end_date')) }}">
            </div>
            <div class="col-md-3">
                <select class="form-control" name="scholarship_id">
                    <option value="">-Course-</option>
                    @foreach (\App\Models\Course::all() as $course)
                    <option value="{{ $course->id }}"
                            {{ old('scholarship_id', request('scholarship_id')) == $course->id ? 'selected' : '' }}>
                        {{ $course->course_manager->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <select name="institution_id" class="form-control">
                    <option value="">All Institutions</option>
                    @foreach (\App\Models\Institution::all() as $institution)
                    <option value="{{ $institution->id }}"
                            {{ request('institution_id') == $institution->id ? 'selected' : '' }}>
                        {{ $institution->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 mt-2">
                <select class="form-control" name="county">
                    <option value="">-County-</option>
                    <option value="baringo" {{ old('county', request('county')) == 'baringo' ? 'selected' : '' }}>
                        Baringo</option>
                    <option value="bomet" {{ old('county', request('county')) == 'bomet' ? 'selected' : '' }}>
                        Bomet</option>
                    <option value="bungoma" {{ old('county', request('county')) == 'bungoma' ? 'selected' : '' }}>
                        Bungoma</option>
                    <option value="busia" {{ old('county', request('county')) == 'busia' ? 'selected' : '' }}>
                        Busia</option>
                    <option value="elgeyo marakwet"
                            {{ old('county', request('county')) == 'elgeyo marakwet' ? 'selected' : '' }}>Elgeyo
                        Marakwet</option>
                    <option value="embu" {{ old('county', request('county')) == 'embu' ? 'selected' : '' }}>
                        Embu</option>
                    <option value="garissa" {{ old('county', request('county')) == 'garissa' ? 'selected' : '' }}>
                        Garissa</option>
                    <option value="homa bay" {{ old('county', request('county')) == 'homa bay' ? 'selected' : '' }}>
                        Homa Bay
                    </option>
                    <option value="isiolo" {{ old('county', request('county')) == 'isiolo' ? 'selected' : '' }}>Isiolo
                    </option>
                    <option value="kajiado" {{ old('county', request('county')) == 'kajiado' ? 'selected' : '' }}>
                        Kajiado</option>
                    <option value="kakamega" {{ old('county', request('county')) == 'kakamega' ? 'selected' : '' }}>
                        Kakamega
                    </option>
                    <option value="kericho" {{ old('county', request('county')) == 'kericho' ? 'selected' : '' }}>
                        Kericho</option>
                    <option value="kiambu" {{ old('county', request('county')) == 'kiambu' ? 'selected' : '' }}>Kiambu
                    </option>
                    <option value="kilifi" {{ old('county', request('county')) == 'kilifi' ? 'selected' : '' }}>Kilifi
                    </option>
                    <option value="kirinyaga" {{ old('county', request('county')) == 'kirinyaga' ? 'selected' : '' }}>
                        Kirinyaga
                    </option>
                    <option value="kisii" {{ old('county', request('county')) == 'kisii' ? 'selected' : '' }}>
                        Kisii</option>
                    <option value="kisumu" {{ old('county', request('county')) == 'kisumu' ? 'selected' : '' }}>Kisumu
                    </option>
                    <option value="kitui" {{ old('county', request('county')) == 'kitui' ? 'selected' : '' }}>
                        Kitui</option>
                    <option value="kwale" {{ old('county', request('county')) == 'kwale' ? 'selected' : '' }}>
                        Kwale</option>
                    <option value="laikipia" {{ old('county', request('county')) == 'laikipia' ? 'selected' : '' }}>
                        Laikipia
                    </option>
                    <option value="lamu" {{ old('county', request('county')) == 'lamu' ? 'selected' : '' }}>
                        Lamu</option>
                    <option value="machakos" {{ old('county', request('county')) == 'machakos' ? 'selected' : '' }}>
                        Machakos
                    </option>
                    <option value="makueni" {{ old('county', request('county')) == 'makueni' ? 'selected' : '' }}>
                        Makueni</option>
                    <option value="mandera" {{ old('county', request('county')) == 'mandera' ? 'selected' : '' }}>
                        Mandera</option>
                    <option value="meru" {{ old('county', request('county')) == 'meru' ? 'selected' : '' }}>
                        Meru</option>
                    <option value="migori" {{ old('county', request('county')) == 'migori' ? 'selected' : '' }}>Migori
                    </option>
                    <option value="marsabit" {{ old('county', request('county')) == 'marsabit' ? 'selected' : '' }}>
                        Marsabit
                    </option>
                    <option value="mombasa" {{ old('county', request('county')) == 'mombasa' ? 'selected' : '' }}>
                        Mombasa</option>
                    <option value="muranga" {{ old('county', request('county')) == 'muranga' ? 'selected' : '' }}>
                        Muranga</option>
                    <option value="nairobi" {{ old('county', request('county')) == 'nairobi' ? 'selected' : '' }}>
                        Nairobi</option>
                    <option value="nakuru" {{ old('county', request('county')) == 'nakuru' ? 'selected' : '' }}>Nakuru
                    </option>
                    <option value="nandi" {{ old('county', request('county')) == 'nandi' ? 'selected' : '' }}>
                        Nandi</option>
                    <option value="narok" {{ old('county', request('county')) == 'narok' ? 'selected' : '' }}>
                        Narok</option>
                    <option value="nyamira" {{ old('county', request('county')) == 'nyamira' ? 'selected' : '' }}>
                        Nyamira</option>
                    <option value="nyandarua" {{ old('county', request('county')) == 'nyandarua' ? 'selected' : '' }}>
                        Nyandarua
                    </option>
                    <option value="nyeri" {{ old('county', request('county')) == 'nyeri' ? 'selected' : '' }}>
                        Nyeri</option>
                    <option value="samburu" {{ old('county', request('county')) == 'samburu' ? 'selected' : '' }}>
                        Samburu</option>
                    <option value="siaya" {{ old('county', request('county')) == 'siaya' ? 'selected' : '' }}>
                        Siaya</option>
                    <option value="taita taveta"
                            {{ old('county', request('county')) == 'taita taveta' ? 'selected' : '' }}>Taita Taveta
                    </option>
                    <option value="tana river"
                            {{ old('county', request('county')) == 'tana river' ? 'selected' : '' }}>Tana River
                    </option>
                    <option value="tharaka nithi"
                            {{ old('county', request('county')) == 'tharaka nithi' ? 'selected' : '' }}>Tharaka
                        Nithi</option>
                    <option value="trans nzoia"
                            {{ old('county', request('county')) == 'trans nzoia' ? 'selected' : '' }}>Trans Nzoia
                    </option>
                    <option value="turkana" {{ old('county', request('county')) == 'turkana' ? 'selected' : '' }}>
                        Turkana</option>
                    <option value="uasin gishu"
                            {{ old('county', request('county')) == 'uasin gishu' ? 'selected' : '' }}>Uasin Gishu
                    </option>
                    <option value="vihiga" {{ old('county', request('county')) == 'vihiga' ? 'selected' : '' }}>Vihiga
                    </option>
                    <option value="wajir" {{ old('county', request('county')) == 'wajir' ? 'selected' : '' }}>
                        Wajir</option>
                    <option value="pokot" {{ old('county', request('county')) == 'pokot' ? 'selected' : '' }}>
                        West Pokot</option>
                </select>

                <p style="height: 10px;">
                    &nbsp;
                </p>
            </div>
            <div class="col-md-2 mt-2">
                <select class="form-control" name="payment_verified">
                    <option value="">-Payment Status-</option>

                    <option value="Yes"
                            {{ old('payment_verified', request('payment_verified')) == 'Yes' ? 'selected' : '' }}>
                        Yes</option>
                    <option value="No"
                            {{ old('payment_verified', request('payment_verified')) == 'No' ? 'selected' : '' }}>
                        No
                    </option>
                </select>
            </div>

            <div class="col-md-2 mt-2">
                <select class="form-control" name="gender">
                    <option value="">-Gender-</option>

                    <option value="male" {{ old('gender', request('gender')) == 'male' ? 'selected' : '' }}>Male
                    </option>
                    <option value="female" {{ old('gender', request('gender')) == 'female' ? 'selected' : '' }}>Female
                    </option>
                </select>
            </div>

            <div class="col-md-2 mt-2">
                <select class="form-control" name="verification_status">
                    <option value="">-Verification Status-</option>

                    <option value="Verified"
                            {{ old('verification_status', request('verification_status')) == 'Verified' ? 'selected' : '' }}>
                        Verified</option>
                    <option value="Not Verified"
                            {{ old('verification_status', request('verification_status')) == 'Not Verified' ? 'selected' : '' }}>
                        Not Verified
                    </option>
                </select>


            </div>
            <div class="col-md-2 mt-2">
                <select class="form-control" name="status">
                    <option value="">-Application Status-</option>
                      <option value="Pending"
                                    {{ old('status', request('status')) == 'Pending' ? 'selected' : '' }}>
                                Pending</option>
                            <option value="Approved"
                                    {{ old('status', request('status')) == 'Approved' ? 'selected' : '' }}>
                                Approved</option>
                            <option value="Query"
                                    {{ old('status', request('status')) == 'Query' ? 'selected' : '' }}>
                                Query</option>
                            <option value="Rejected"
                                    {{ old('status', request('status')) == 'Rejected' ? 'selected' : '' }}>
                                Rejected</option>
                            <option value="Selected"
                                    {{ old('status', request('status')) == 'Selected' ? 'selected' : '' }}>
                                Selected</option>
                </select>

            </div>
            <div class="col-md-2 mt-2">
                <select class="form-control" name="stage">
                    <option value="">-Stage-</option>
                    <option value="10%" {{ old('stage', request('stage')) == '25%' ? 'selected' : '' }}>25%
                        Submited Application
                    </option>
                    <option value="20%" {{ old('stage', request('stage')) == '50%' ? 'selected' : '' }}>50%
                        Uploaded Pre-Auth Pre-Auth
                    </option>
                    <option value="30%" {{ old('stage', request('stage')) == '75%' ? 'selected' : '' }}>75%
                        Verified
                    </option>
                    <option value="40%" {{ old('stage', request('stage')) == '100%' ? 'selected' : '' }}>100%
                        Uploaded Bonding Form
                    </option>

                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="{{ url('admin/enrollments') }}" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </form>
</div>

<div class="row">
    <section id="minimal-statistics">
        <div class="row">
            <div class="col-12 mt-0 mb-1">
                <h4 class="text-uppercase">Dashboard</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="icon-users primary font-large-2 float-left"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3>{{ $enrollments->count() }} | <small style="font-size:12px">
                                            Male:{{ count(
                                                    $enrollments->filter(function ($item) {
                                                        return $item->application && $item->application->gender == 'male';
                                                    }),
                                                ) }},
                                            Female:{{ count(
                                                    $enrollments->filter(function ($item) {
                                                        return $item->application && $item->application->gender == 'female';
                                                    }),
                                                ) }}
                                        </small></h3>
                                    <span>All Applications</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="icon-cloud-upload warning font-large-2 float-left"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3>
                                        {{ count(
                                                $enrollments->filter(function ($item) {
                                                    return strpos($item->application && $item->application->authorized_form, 'pre_auth_forms') !== false;
                                                }),
                                            ) }}
                                    </h3>
                                    <span>Uploaded Pre-Auth Forms</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="icon-check success font-large-2 float-left"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3> {{ count(
                                            $enrollments->filter(function ($item) {
                                                return $item->application && $item->application->verification_status == 'Verified';
                                            }),
                                        ) }}
                                    </h3>
                                    <span>Applications Verified</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="icon-list danger font-large-2 float-left"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3>
                                        {{ count(
                                                $enrollments->filter(function ($item) {
                                                    return $item->application && $item->application->short_listing_status == 'Shortlisted';
                                                }),
                                            ) }}
                                    </h3>
                                    <span>No. Shortlisted</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="icon-graduation danger font-large-2 float-left"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3>
                                        {{ count(
                                                $enrollments->filter(function ($item) {
                                                    return strpos($item->application && $item->application->bonding_form, 'bonding_form') !== false;
                                                }),
                                            ) }}
                                    </h3>
                                    <span>Uploaded Bonding Forms</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6 col-12">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    <i class="icon-graph danger font-large-2 float-left"></i>
                                </div>
                                <div class="media-body text-right">
                                    <h3>
                                        {{ $enrollments->count() > 0
                                                ? number_format(
                                                        (count(
                                                            $enrollments->filter(function ($item) {
                                                                return strpos($item->application && $item->application->bonding_form, 'bonding_form') !== false;
                                                            }),
                                                        ) /
                                                            $enrollments->count()) *
                                                            100,
                                                        0,
                                                    ) . '%'
                                                : 'N/A' }}
                                    </h3>
                                    <span>% Admitted</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

<div class="row">
    <div class="col-12 mt-0 mb-1">
        <h4 class="text-uppercase">Scholarship Applications</h4>
    </div>
</div>


<div class="card">

    <center>
        <div id="loader-container">
            <div style="margin-left:48vw;" id="loader"></div>
            <p id="loading-message">Please wait, Dispatching emails to Shortlisted applicants!</p>
        </div>
    </center>
    <div class="card-header">
        Scholarship Applications

    </div>

    <div class="card-body">
<!--        <div class="alert alert-danger">
            Verify Payment by reviewing proof of payment under personal documents
        </div>-->
        <div class="card-body">
            <!-- Add filter inputs for start and end date -->


            <p style="height: 10px;">
                &nbsp;
            </p>

            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Enrollment">
                    <thead>
                        <tr>
                            <th>

                                No
                            </th>
                            <th style="width: 20px;">

                                Paid?
                            </th>
                            <th>

                                Institution
                            </th>
                            <th>

                                Name
                            </th>

                            <th>

                                Course
                            </th>
                            <th>

                                Application Date
                            </th>
                            <th>

                                Age
                            </th>
                            <th>

                                County
                            </th>

                            <th>

                                Date of Birth
                            </th>

                            <th>

                                Gender
                            </th>

                            <th>

                                Personal Documents
                            </th>
                            <th>

                                Pre-Auth Form
                            </th>


                            <th>Processing Status</th>

<!--                            <th>

                                Verification Status
                            </th>-->
                            <th>

                                Sent Bonding Form
                            </th>
                            <th>

                                Bonding & Release Form
                            </th>
<!--                            <th>

                                Action
                            </th>

                            <th>

                                Messaging / Reminder
                            </th>-->
                            <th>

                                National ID
                            </th>
                            <th>

                                Applicant Phone No.
                            </th>
                            <th>

                                Job Group
                            </th>

                            <th> Country</th>
                            <th>Town/City</th>
                            <th> Affiliated Hospital</th>
                            <th> Years Worked</th>
                            <th> Pre-auth Institution Work Years</th>
                            <th> License Number</th>
                            <th> Registration Number</th>
                            <th> Monthly Salary</th>
                            <th> Phone Number</th>
                            <th> Email</th>
                            <th> Date of Birth</th>
                            <th> Age (Years)</th>
                            <th> Date to Begin</th>
                            <th> Speciality</th>
                            <th> Training Institution With</th>
                            <th> Funding Source</th>
                            <th> Funding Source Description</th>
                            <th> Supervisor Title</th>
                            <th> Supervisor Full Name</th>
                            <th> Supervisor Designation</th>
                            <th> Supervisor Phone Number</th>
                            <th> Supervisor Email</th>
                            <th> Supervisor Department</th>
                            <th> Emergency First Name</th>
                            <th> Emergency Surname</th>
                            <th> Emergency Title</th>
                            <th> Emergency First Contact Number</th>
                            <th> Emergency Second Contact Number</th>
                            <th> Emergency Email</th>
                            <th> Emergency Relationship</th>
                            <th> Reference Contact 1</th>
                            <th> Reference Contact 2</th>
                            <th> Reference Contact 3</th>
                            <th> Short Listing Status</th>
                            <th> Short Listed By</th>
                            <th> Stage</th>
                            <th> Comments</th>
                            <th> Verified By</th>


                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i = 1;
                        @endphp
                        @foreach ($enrollments as $key => $enrollment)
                        @php
                        $load_payment_proof = App\Models\PaymentProof::where(
                        'application_id',
                        $enrollment->application_id,
                        )
                        ->where('scholarship_id', $enrollment->scholarship_id)
                        ->get();
                        @endphp
                        <tr data-entry-id="{{ @$enrollment->application->id }}" {{ @$enrollment->application->verification_status == 'Verified' ? 'style=background-color:#88e788;color:#000000;' : '' }}>

                    <div class="modal" id="queryModal{{ @$enrollment->application->id }}"
                         tabindex="-1" role="dialog">
                        <form
                            action="{{ route('admin.application.update.status.form', [@$enrollment->application->id]) }}"
                            method="post">
                            {{ @csrf_field() }}
                            <input type="hidden" name="status" value="Query">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Query Details</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Query Details</label>
                                            <textarea class="form-control" name="comments" rows="4" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Submit
                                            Query</button>
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Rejected Modal -->
                    <div class="modal" id="rejectModal{{ @$enrollment->application->id }}"
                         tabindex="-1" role="dialog">
                        <form
                            action="{{ route('admin.application.update.status.form', [$enrollment->application->id]) }}"
                            method="post">
                            {{ @csrf_field() }}
                            <input type="hidden" name="status" value="Rejected">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Rejection Reason</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Reason for Rejection</label>
                                            <textarea class="form-control" name="comments" rows="4" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Submit
                                            Rejection</button>
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Selected Modal -->
                    <div class="modal" id="selectedModal{{ @$enrollment->application->id }}"
                         tabindex="-1" role="dialog">
                        <form
                            action="{{ route('pre.auth.save', [$enrollment->application->id, $enrollment->application->scholarship_id]) }}"
                            method="post" enctype="multipart/form-data">
                            {{ @csrf_field() }}
                            <input type="hidden" name="status" value="Selected">
                            <input type="hidden" name="document_id" value="16">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Send Bonding Form & Other relevant Documents(.zip Format)</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Upload Archive</label>
                                            <input type="file" class="form-control"
                                                   name="document" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Comments (Optional)</label>
                                            <textarea class="form-control" name="comments" rows="4"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <td>
                        {{ $i }}
                    </td>


                    <td class=""
                        style="background-color:{{ @$enrollment->application->payment_verified == 'No' ? '#E8422F;color:white;' : '#4C9F38;color:white;' }}">
                        {{ @$enrollment->application->payment_verified }}
                    </td>
                    <td>
                        {{@$enrollment->institution->name}}
                    </td>
                    <td>
                        {{ @$enrollment->application->preffered_name . ' ' . @$enrollment->application->surname . ' ' . @$enrollment->application->first_name }}
                    </td>

                    <td>
                        {{@$enrollment->course->course_manager->name}}
                    </td>
                    <td>
                        {{ @$enrollment->application->created_at }}
                    </td>
                    <td>
                        {{ @$enrollment->application->age_years }}
                    </td>
                    <td>
                        {{ @$enrollment->application->county }}
                    </td>

                    <td>
                        {{ @$enrollment->application->date_of_birth }}
                    </td>
                    <td>
                        {{ @$enrollment->application->gender }}
                    </td>

                    <td>
                        <a class=""Statement target="_blank"
                           href="{{ route('admin.document.manager', ['course_id' => $enrollment->scholarship_id, 'student_id' => $enrollment->application_id, 'institution_id' => @$enrollment->institution_id]) }}">View
                            Documents</a>

                    </td>
                    <td>
                        <a class=""Statement target="_blank"
                           href="{{ route('admin.document.manager', ['course_id' => $enrollment->scholarship_id, 'student_id' => $enrollment->application_id, 'institution_id' => @$enrollment->institution_id, 'document_id' => '15']) }}">Download
                            Pre-Auth</a>

                    </td>

                    <td>

                        <select class="form-control processing-status"
                                data-application-id="{{ @$enrollment->application->id }}"
                                data-scholarship-id="{{ @$enrollment->scholarship_id }}">
                            <option value="Pending"
                                    {{ @$enrollment->application->status == 'Pending' ? 'selected' : '' }}>
                                Pending</option>
                            <option value="Approved"
                                    {{ @$enrollment->application->status == 'Approved' ? 'selected' : '' }}>
                                Approved</option>
                            <option value="Query"
                                    {{ @$enrollment->application->status == 'Query' ? 'selected' : '' }}>
                                Query</option>
                            <option value="Rejected"
                                    {{ @$enrollment->application->status == 'Rejected' ? 'selected' : '' }}>
                                Rejected</option>
                            <option value="Selected"
                                    {{ @$enrollment->application->status == 'Selected' ? 'selected' : '' }}>
                                Selected</option>
                        </select>
                    </td>
<!--                    <td>
                        {{@$enrollment->application->verification_status }}
                    </td>-->

                    <td>
                        @if (@$enrollment->application->bonding_form == 'Not Sent')
                        Not Sent
                        @else
                        Sent. <a href="{{ @Storage::url($enrollment->application->bonding_form_link->file_path) }}"
                                 target="_blank">Download</a>
                        @endif
                    </td>

                    <td>
                        @if (@$enrollment->application->release_and_bonding_form == '0')
                        Not Uploaded
                        @else
                        <a href="{{ @Storage::url($enrollment->application->release_and_bonding_form_link->file_path) }}"
                                 target="_blank">Download</a>
                        @endif
                    </td>
<!--                    <td>
                        @can('enrollment_show')
                        @if (@$enrollment->application->verification_status == 'Verified')
                        <a href="{{ route('admin.undo.verify', [$enrollment->scholarship_id, $enrollment->application_id]) }}"
                           class="btn btn-sm btn-warning">Undo Verification</a>
                        @else
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#scholarshipModal{{ @$enrollment->scholarship_id . @$enrollment->application_id }}">
                            Verify
                        </button>
                        @endif

                        <div class="modal"
                             id="scholarshipModal{{ @$enrollment->scholarship_id . @$enrollment->application_id }}"
                             tabindex="-1" role="dialog">
                            <form
                                action="{{ route('admin.application.verify', [$enrollment->scholarship_id, $enrollment->application_id]) }}"
                                method="post">
                                {{ @csrf_field() }}
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Scholarship Application Verification
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>I duly confirm that I have gone through the scholarship
                                                application for this candidate
                                                (<b>{{ @$enrollment->application->preffered_name . ' ' . @$enrollment->application->surname . ' ' . @$enrollment->application->first_name }}</b>)
                                                and confirm that all documentation and information required
                                                has
                                                been provided.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-success"
                                                   value="Mark as Verified">
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endcan

                    </td>
                    <td>
                        <a class="btn btn-sm btn-warning"
                           href="{{ route('messaging.index', [auth()->user()->id, $enrollment->application_id]) }}">Open</a>

                        </a>
                    </td>-->
                    <td>
                        {{ @$enrollment->application->national_id_pass }}
                    </td>
                    <td>
                        {{ @$enrollment->application->phone_no }}
                    </td>
                    <td>
                        {{ @$enrollment->application->job_group }}
                    </td>
                    <td>{{ @$enrollment->application->country }}</td>
                    <td>{{ @$enrollment->application->town_city }}</td>
                    <td>{{ @$enrollment->application->affiliated_hospital }}</td>
                    <td>{{ @$enrollment->application->years_worked }}</td>
                    <td>{{ @$enrollment->application->preauth_inst_no_of_work_yrs }}</td>
                    <td>{{ @$enrollment->application->license_no }}</td>
                    <td>{{ @$enrollment->application->registration_no }}</td>
                    <td>{{ @$enrollment->application->monthly_salary }}</td>
                    <td>{{ @$enrollment->application->license_no }}</td>
                    <td>{{ @$enrollment->application->email_ }}</td>
                    <td>{{ @$enrollment->application->date_of_birth }}</td>
                    <td>{{ @$enrollment->application->age_years }}</td>
                    <td>{{ @$enrollment->application->date_to_begin }}</td>
                    <td>{{ @$enrollment->application->speciality }}</td>
                    <td>{{ @$enrollment->application->training_institution_with }}</td>
                    <td>{{ @$enrollment->application->funding_source }}</td>
                    <td>{{ @$enrollment->application->funding_source_yes_desc }}</td>
                    <td>{{ @$enrollment->application->supervisor_title }}</td>
                    <td>{{ @$enrollment->application->supervisor_full_name }}</td>
                    <td>{{ @$enrollment->application->supervisor_designation }}</td>
                    <td>{{ @$enrollment->application->supervisor_phone_no }}</td>
                    <td>{{ @$enrollment->application->supervisor_email }}</td>
                    <td>{{ @$enrollment->application->supervisor_department }}</td>
                    <td>{{ @$enrollment->application->emergency_first_name }}</td>
                    <td>{{ @$enrollment->application->emergency_surname }}</td>
                    <td>{{ @$enrollment->application->emergency_title }}</td>
                    <td>{{ @$enrollment->application->emergency_first_contact_no }}</td>
                    <td>{{ @$enrollment->application->emergency_secondcontact_no }}</td>
                    <td>{{ @$enrollment->application->emergency_email }}</td>
                    <td>{{ @$enrollment->application->emergency_relationship }}</td>
                    <td>{{ @$enrollment->application->reference_previous_1 }}</td>
                    <td>{{ @$enrollment->application->reference_previous_2 }}</td>
                    <td>{{ @$enrollment->application->reference_previous_3 }}</td>
                    <td>{{ @$enrollment->application->short_listing_status }}</td>
                    <td>{{ @$enrollment->application->short_listed_by }}</td>
                    <td>{{ @$enrollment->application->stage }}</td>
                    <td>{{ @$enrollment->application->comments }}</td>
                    <td>{{ @$enrollment->application->verified_by }}</td>



                    </tr>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>



    @endsection

    @section('scripts')
    @parent

    <script>
        function showLoader() {
            $('#loader-container').show();
        }

        // Function to hide the loader
        function hideLoader() {
            $('#loader-container').hide();
        }


        $(function () {


            $('.processing-status').change(function () {
                var status = $(this).val();
                var applicationId = $(this).data('application-id');
                var scholarshipId = $(this).data('scholarship-id');
                if (status === 'Query') {
                    $('#queryModal' + applicationId).modal('show');
                } else if (status === 'Rejected') {
                    $('#rejectModal' + applicationId).modal('show');
                } else if (status === 'Selected') {
                    $('#selectedModal' + applicationId).modal('show');
                } else {
                    // For Pending and Approved, directly update via AJAX
                    $.ajax({
                        url: "{{ url('/admin/application-update-status') }}/" + applicationId,
                        method: 'POST',
                        data: {
                            status: status,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            alert('Status updated successfully');
                        },
                        error: function (xhr) {
                            alert('Error updating status');
                            // Revert the dropdown to previous value if needed
                        }
                    });
                }
            });
            // $('#loader-container').show();

            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            @can('enrollment_show')
                    let deleteButtonTrans = ''
            let deleteButton = {
                text: 'SEND BONDING FORM',
                url: "{{ route('admin.send.bonding.form') }}",
                className: 'btn-primary',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({
                        selected: true
                    }).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });
                    if (ids.length === 0) {
                        alert('No application selected!')

                        return
                    }


                    if (confirm(
                            'By clicking OK, you confirm that you are shortlisting the selected candidates and emailing them the bonding form.'
                            )) {
                        showLoader();
                        $.ajax({
                            headers: {
                                'x-csrf-token': _token
                            },
                            method: 'POST',
                            url: config.url,
                            data: {
                                ids: ids,
                                _method: 'POST'
                            }
                        })
                                .done(function () {
                                    hideLoader();
                                    location.reload();
                                    //toastr.success('Emails successfully dispatched!');
                                    /*setInterval(() => {
                                     location.reload();
                                     }, 10);*/

                                })
                    }
                }
            }
            // dtButtons.push(deleteButton)
            @endcan
                    @can('enrollment_access')
                    let verifyPaymentButtonTrans = ''
            let verifyPaymentButton = {
                text: 'VERIFY PAYMENTS',
                url: "{{ route('admin.send.verification.form') }}",
                className: 'btn-secondary',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({
                        selected: true
                    }).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });
                    if (ids.length === 0) {
                        alert('No application selected!')

                        return
                    }


                    if (confirm(
                            'By clicking OK, you confirm that the candidate has paid their full application fees as required by the set  policies '
                            )) {
                        showLoader();
                        $.ajax({
                            headers: {
                                'x-csrf-token': _token
                            },
                            method: 'POST',
                            url: config.url,
                            data: {
                                ids: ids,
                                _method: 'POST'
                            }
                        })
                                .done(function () {
                                    hideLoader();
                                    toastr.success('Payment(s) successfully verified!');
                                    setInterval(() => {
                                        // window.location.href=""
                                    }, 10);
                                })
                    }
                }
            }
            dtButtons.push(verifyPaymentButton)
            @endcan


                    $.extend(true, $.fn.dataTable.defaults, {
                    order: [
                    [0, 'asc']
                    ],
                            pageLength: 100,
                });
        $('.datatable-Enrollment:not(.ajaxTable)').DataTable({
            buttons: dtButtons,
        })
        $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        $($.fn.dataTable.tables(true)).DataTable()
                .columns.adjust();
        });
        }
        )
    </script>
    @endsection
