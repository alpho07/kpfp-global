@extends('layouts.main')
@section('content')

    <style>
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }
    </style>
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
                                Status
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

                                Doc Verification Status
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
                                            href="{{ route('application.download', [$enrollment->id, $enrollment->scholarship_id]) }}">Download</a>
                                    </td>
                                    <td>
                                        @if ($enrollment->application && $enrollment->application->authorized_form == 'Not Uploaded')
                                            <a class="btn btn-sm btn-info"
                                                href="{{ route('pre.auth.upload', [$enrollment->id, $enrollment->scholarship_id]) }}">Upload
                                            </a>
                                        @else
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ @Storage::url($enrollment->application->authorized_form_link->file_path) }}">Download</a><br>
                                            <p>Or</p>
                                            <a class="btn btn-sm btn-info"
                                                href="{{ route('pre.auth.upload', [$enrollment->id, $enrollment->scholarship_id]) }}">Re-Upload!
                                                <small style="font-size: 8px;">Only if you submitted a wrong form</small>
                                            </a>
                                        @endif

                                    </td>
                                    <td>
                                        <ol>
                                            <li><a class=""Statement
                                                    href="{{ route('apply.scholarship', [$enrollment->id, $enrollment->scholarship_id]) }}?q=#step-2"
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
                                        <span
                                            class="badge badge-{{ in_array(@$enrollment->application->status, ['Rejected', 'Query']) ? 'danger' : 'success' }}">{{ @$enrollment->application->status }}</span><br>
                                        @if (in_array(@$enrollment->application->status, ['Rejected', 'Query']))
                                            <a href="#" onclick="alert('{{ @$enrollment->application->comments }}');" tabindex="0"
                                                class="btn btn-sm btn-link text-primary" role="button"
                                                data-toggle="popover" data-trigger="focus"
                                                title="Reason: {{ @$enrollment->application->comments }}">
                                                Why?
                                            </a>
                                        @endif

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
                                            <a class=""
                                                href="{{ route('bonding.form.upload', [$enrollment->id, $enrollment->scholarship_id]) }}">
                                                Upload
                                            </a>
                                        @else
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ @Storage::url($enrollment->application->bonding_form_link->file_path) }}">Download</a>
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
                                                href="{{ route('apply.scholarship', [$enrollment->id, $enrollment->scholarship_id]) }}">
                                                Edit
                                            </a>
                                        </td>
                                    @endif

                                </tr>

                                @if (\is_null($enrollment->application->bonding_form_link->file_path ))
                                    <tr>
                                        <td colspan="16">

                                            <div class="alert alert-danger">
                                                Hello {{ auth()->user()->first_name }}, Your have completed the application
                                                process but please note that your application will only be considered if you
                                                have paid the required application fee. <a
                                                    href="{{ route('proof.auth.load', [$enrollment->id, $enrollment->scholarship_id]) }}">See
                                                    More</a>
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
                                <td colspan="16">
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
