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
        <form action="{{ url('admin/self-enrollments') }}" method="GET">
            <div class="row mb-2">
                <div class="col-md-3">
                    <input type="date" class="form-control" name="start_date" placeholder="Start Date"
                        value="{{ old('start_date', request('start_date')) }}">
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control" name="end_date" placeholder="End Date"
                        value="{{ old('start_date', request('end_date')) }}">
                </div>
                <div class="col-md-2">
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
                <div class="col-md-2">
                    <select class="form-control" name="payment_verified">
                        <option value="">-Payment Status-</option>

                        <option value="Yes"
                            {{ old('payment_verified', request('payment_verified')) == 'Yes' ? 'selected' : '' }}>
                            Yes</option>
                        <option value="pending"
                            {{ old('payment_verified', request('payment_verified')) == 'pending' ? 'selected' : '' }}>
                            No
                        </option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select class="form-control" name="course">
                        <option value="">-Course-</option>
                            @foreach ($courses as $c)
                        <option value="{{$c->name}}" {{(request('course')) == $c->name ? 'selected' : ''}}>{{$c->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select class="form-control" name="status">
                        <option value="">-Status-</option>
                        <option value="pending" {{ old('status', request('status')) == 'pending' ? 'selected' : '' }}>
                            Pending</option>

                        <option value="Verified" {{ old('status', request('status')) == 'Verified' ? 'selected' : '' }}>
                            Verified</option>
                        <option value="Award Sent"
                            {{ old('status', request('status')) == 'Award Sent' ? 'selected' : '' }}>
                            Award Sent
                        </option>
                    </select>


                </div>
                <div class="col-md-2">


                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ url('admin/self-enrollments') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>


    <div class="row col-12">
        <section id="minimal-statistics">
            <div class="row">
                <div class="col-12 mt-0 mb-1">
                    <h4 class="text-uppercase">Dashboard</h4>
                </div>
            </div>

        </section>

    </div>

    <div class="row col-md-12">
        <div class="col-md-4 ">
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
                                                return $item->gender == 'Male';
                                            }),
                                        ) }},
                                        Female:{{ count(
                                            $enrollments->filter(function ($item) {
                                                return $item->gender == 'Female';
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
        <div class="col-md-4">
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
                                            return $item->payment_verified == 'Yes';
                                        }),
                                    ) }}
                                </h3>
                                <span>Verified Payments</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
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
                                        return $item->status == 'Award Sent';
                                    }),
                                ) }}
                                </h3>
                                <span>Award Letters Sent</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-12 mt-0 mb-1">
            <h4 class="text-uppercase">Course Applications</h4>
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
            <div class="alert alert-danger">
                Verify Payment by reviewing proof of payment under personal documents
            </div>
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
                                    <p><b>A.</b></p>
                                    No
                                </th>
                                <th>
                                    <p><b>B.</b></p>
                                    Payment Status
                                </th>

                                <th>
                                    <p><b>C.</b></p>
                                    Name
                                </th>
                                <th>
                                    <p><b>C<sub>1</sub>.</b></p>
                                    Personal Files
                                </th>
                                <th>
                                    <p><b>D.</b></p>
                                    Course
                                </th>
                                <th>
                                    <p><b>E.</b></p>
                                    Course Category
                                </th>
                                <th>
                                    <p><b>F.</b></p>
                                    Period
                                </th>

                                <th>
                                    <p><b>G.</b></p>

                                    Phone Number
                                </th>

                                <th>
                                    <p><b>H.</b></p>
                                    Gender
                                </th>

                                <th>
                                    <p><b>I.</b></p>
                                    Date of birth
                                </th>
                                <th>
                                    <p><b>J.</b></p>
                                    Age
                                </th>
                                <th>
                                    <p><b>K.</b></p>
                                    Status
                                </th>
                                <th>
                                    <p><b>L.</b></p>
                                    Application Date
                                </th>
                                <th>
                                    <p><b>M.</b></p>
                                    Sponsorship Type
                                </th>
                                <th>
                                    <p><b>N.</b></p>
                                    Verify
                                </th>
                                <th>
                                    <p><b>O.</b></p>
                                    Chat
                                </th>


                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($enrollments as $key => $enrollment)
                                @php
                                    $load_payment_proof = App\PaymentProof::where(
                                        'application_id',
                                        $enrollment->application_id,
                                    )->get();
                                @endphp
                                <tr data-entry-id="{{ @$enrollment->id }}">
                                    <td>
                                        {{ $i }}
                                    </td>

                                    <td class=""
                                        style="background-color:{{ @$enrollment->payment_verified == 'Yes' ? '#4C9F38;color:white;' : '#E8422F;color:white;' }}">
                                        {{ @$enrollment->payment_verified }}
                                    </td>
                                    <td>
                                        {{ @$enrollment->name }}
                                    </td>
                                    <td>
                                        <ol>
                                            <li>
                                                <a href={{ Storage::url(@$enrollment->sponsorship_id) }}>Proof of
                                                    Payment</a>
                                            </li>
                                            <li>
                                                <a href={{ Storage::url(@$enrollment->national_id) }}>National_ID</a>
                                            </li>
                                            <li>
                                                <a href={{ Storage::url(@$enrollment->nck_lic) }}>NCK LIC</a>
                                            </li>
                                            <li>
                                                <a href={{ Storage::url(@$enrollment->nck_cert) }}>NCK CERT</a>
                                            </li>
                                            <li>
                                                <a href={{ Storage::url(@$enrollment->kcse_cse) }}>KCSE/CSE</a>
                                            </li>
                                            <li>
                                                <a href={{ Storage::url(@$enrollment->passport) }}>Passport</a>
                                            </li>
                                        </ol>
                                    </td>
                                    <td>
                                        {{ @$enrollment->course }}
                                    </td>
                                    <td>
                                        {{ @$enrollment->category }}
                                    </td>
                                    <td>
                                        {{ @$enrollment->period }}
                                    </td>

                                    <td>
                                        {{ @$enrollment->phone }}
                                    </td>
                                    <td>
                                        {{ @$enrollment->gender }}
                                    </td>
                                    <td>
                                        {{ @$enrollment->dob }}
                                    </td>

                                    <td>
                                        {{ @$enrollment->age }}
                                    </td>

                                    <td>
                                        <span class="badge badge-info"> {{ @$enrollment->status }}</span>
                                    </td>

                                    <td>
                                        {{ @$enrollment->created_at }}
                                    </td>

                                    <td>
                                        {{ @$enrollment->sponsorship_type }}
                                    </td>


                                    <td>
                                        @can('enrollment_show')
                                            @if (@$enrollment->status == 'Verified' || @$enrollment->status == 'pending')
                                                @if (@$enrollment->status == 'Verified')
                                                    <a href="{{ route('admin.undo.verify.self', $enrollment->id) }}"
                                                        class="btn btn-sm btn-warning">Undo Verification</a>
                                                @else
                                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                                        data-target="#scholarshipModal{{ @$enrollment->id }}">
                                                        Verify
                                                    </button>
                                                @endif
                                            @endif


                                            <div class="modal" id="scholarshipModal{{ @$enrollment->id }}" tabindex="-1"
                                                role="dialog">
                                                <form action="{{ route('admin.application.verify.self', $enrollment->id) }}"
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
                                                                <p>I duly confirm that I have gone through
                                                                    (<b>{{ @$enrollment->name }}</b>)
                                                                    application documents and can confirm that all documentation
                                                                    and information required
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
                                            href="{{ route('messaging.index', [auth()->user()->id, $enrollment->application_id]) }}">Chat</a>

                                        </a>
                                    </td>



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


            $(function() {
                // $('#loader-container').show();

                let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

                @can('enrollment_show')
                    let deleteButtonTrans = ''
                    let deleteButton = {
                        text: 'SEND AWARD LETTER',
                        url: "{{ route('admin.send.award.form') }}",
                        className: 'btn-primary',
                        action: function(e, dt, node, config) {
                            var ids = $.map(dt.rows({
                                selected: true
                            }).nodes(), function(entry) {
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
                                    .done(function() {
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
                    dtButtons.push(deleteButton)

                    @endcan
                    @can('applications_manager')
                    let verifyPaymentButtonTrans = ''
                    let verifyPaymentButton = {
                        text: 'VERIFY PAYMENTS',
                        url: "{{ route('admin.send.verification.form.self') }}",
                        className: 'btn-secondary',
                        action: function(e, dt, node, config) {
                            var ids = $.map(dt.rows({
                                selected: true
                            }).nodes(), function(entry) {
                                return $(entry).data('entry-id')
                            });

                            if (ids.length === 0) {
                                alert('No application selected!')

                                return
                            }


                            if (confirm(
                                    'By clicking OK, you confirm that the candidate has paid their full application fees as required by the set policies'
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
                                    .done(function() {
                                        hideLoader();
                                        alert('Payment(s) successfully verified!');

                                        window.location.href = ""


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
            })
        </script>
    @endsection
