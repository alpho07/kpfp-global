@extends('layouts.main')
@section('content')
    <div class="card">


        <div class="card-header">
            <b>SCHOLARSHIP APPLICATIONS - PORTAL</b>

        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Enrollment">
                    <thead>
                        <tr>

                            <th>
                                No.
                            </th>

                            <th>

                                Pre-Auth Original
                                Unsigned
                            </th>
                            <th>

                                Pre-Auth Form
                                Signed
                            </th>
                            <th>

                                Personal Documents
                            </th>
                            <th>

                                Name
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

                                National ID
                            </th>
                            <th>

                                Date of Birth
                            </th>

                            <th>

                                Gender
                            </th>

                            <th>

                                Phone Number
                            </th>

                            <th>

                                Bonding Form
                            </th>
                            <th>

                                Verification Status
                            </th>


                            <th>

                                Actions
                            </th>

                        </tr>
                    </thead>
                    @if (count($enrollments) > 0)
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

                                <tr data-entry-id="{{ $enrollment->id }}">

                                    <td>
                                        {{ $i }}
                                    </td>

                                    <td>
                                        <a class="btn btn-sm btn-primary"
                                            href="{{ route('application.download',  [$enrollment->id,$enrollment->scholarship_id]) }}">Download</a>
                                    </td>
                                    <td>
                                        @if ($enrollment->application && $enrollment->application->authorized_form == 'Not Uploaded')
                                            <a class="btn btn-sm btn-info"
                                                href="{{ route('pre.auth.upload', [$enrollment->scholarship_id, $enrollment->application_id]) }}">Upload
                                            </a>
                                        @else
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ @Storage::url($enrollment->application->authorized_form) }}">Download</a><br>
                                            <p>Or</p>
                                            <a class="btn btn-sm btn-info"
                                                href="{{ route('pre.auth.upload', [$enrollment->scholarship_id, $enrollment->application_id]) }}">Re-Upload!
                                                <small style="font-size: 8px;">Only if you submitted a wrong form</small>
                                            </a>
                                        @endif

                                    </td>
                                    <td>
                                        <ol>
                                            <li><a class=""Statement
                                                    href=""
                                                    target="_blank">Personal Files</a>
                                            </li>

                                        </ol>
                                    </td>
                                    <td>
                                        {{ @$enrollment->application->preffered_name . ' ' . @$enrollment->application->surname . ' ' . @$enrollment->application->first_name }}
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
                                        {{ @$enrollment->application->national_id_pass }}
                                    </td>
                                    <td>
                                        {{ @$enrollment->application->date_of_birth }}
                                    </td>
                                    <td>
                                        {{ @$enrollment->application->gender }}
                                    </td>

                                    <td>
                                        {{ @$enrollment->application->phone_no }}
                                    </td>

                                    <td>

                                        @if ($enrollment->application && $enrollment->application->bonding_form == 'Not Sent')
                                            Not Applicable
                                        @elseif($enrollment->application && $enrollment->application->bonding_form == 'Sent')
                                            <a class="" href="{{ route('bonding.form.upload', $enrollment->id) }}">
                                                Upload
                                            </a>
                                        @else
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ @Storage::url($enrollment->application->bonding_form) }}">Download</a>
                                        @endif


                                    </td>
                                    <td>
                                        {{ empty($enrollment->application->verification_status) ? 'pending' : $enrollment->application->verification_status }}
                                    </td>
                                    @if ($enrollment->application && $enrollment->application->authorized_form !== 'Not Uploaded')
                                        <td>
                                            -
                                        </td>
                                    @else
                                        <td>
                                            <a class="btn btn-xs btn-primary"
                                                href="{{ route('apply.scholarship', [$enrollment->id,$enrollment->scholarship_id]) }}">
                                                Edit
                                            </a>
                                        </td>
                                    @endif

                                </tr>

                                @if ($load_payment_proof->count() == 0)
                                    <tr>
                                        <td colspan="15">

                                            <div class="alert alert-danger">
                                                Hello {{ auth()->user()->first_name }}, Your have completed the application
                                                process but please note that your application will only be considered if you
                                                have paid the required application fee of KES. 2,000.00. Please Click <a
                                                    href="{{ route('proof.auth.load', [$enrollment->scholarship_id, $enrollment->application_id]) }}"
                                                    class="btn btn-sm btn-primary">Here</a> to upload your proof of payment
                                                e.g. scanned receipts, mpesa message etc.
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </tbody>
                    @else
                    <tbody>
                        <tr>
                            <td colspan="15">
                                <div class="alert alert-warning">You seem not applied for any Scholarships, <b><a
                                    href="{{ route('home') }}">Explore Available Scholarships </a></b></div>
                            </td>
                        </tr>
                    </tbody>
                    @endif
                </table>
            </div>


        </div>
    </div>
@endsection
