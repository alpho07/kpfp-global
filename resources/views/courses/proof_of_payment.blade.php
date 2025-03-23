@extends('layouts.main')

@section('content')
    <style>
        /* Apply a shadow to the outer border of the table */

        /* Apply blue outline border to all input elements */
        input[type=text],
        input[type=number],
        textarea {
            border: 1px solid #3498db;
            /* Set the border color to blue */
            outline: none;
            /* Remove the default outline */
            padding: 8px;
            /* Add padding for better appearance */
        }

        /* Add a subtle box shadow on focus to indicate interaction */
        input:focus {
            box-shadow: 0 0 8px rgba(52, 152, 219, 0.7);
            /* Add a blue box shadow on focus */
        }


        input[type="checkbox"]::before {
            content: "";
            width: 0.65em;
            height: 0.65em;
            transform: scale(0);
            transition: 120ms transform ease-in-out;
            box-shadow: inset 1em 1em var(--form-control-color);
            background-color: CanvasText;
        }

        input[type="checkbox"]:checked::before {
            transform: scale(1);
        }




        .paper-style {

            background-color: #fff;
            border: 1px solid #0397D6;

        }

        .sw-btn {
            display: none !important;
        }
    </style>
    <section class=" section_padding_1 " style="background: #E6E6E6;margin-top:150px;">

        <div class="container card">
            <div class="card-title">
                <h4>Upload | Application Fee Proof of Payment </h4>
                <div class="alert alert-primary">
                    <h3>Instructions</h3>
                    <ol>
                        <li>Using details provided below. Pay the application fee of Ksh <b>({{number_format($payment_details[0]->amount,2) ?? ''}})</b> to the account provided. Bank of MPESA</li>
                        <li>Once payment is made, upload a scanned copy of the payment receipt in pdf format</li>
                        <li>Wait for feedback regarding your application</li>
                    </ol>

                        <b><u>MPESA Details</u></b><br>
                        Paybill: {{$payment_details[0]->mobile_paybill ?? ''}}<br>
                        Account: {{$payment_details[0]->mobile_paybill_no ?? ''}}<br><br>

                    <p></p><b><u>BANK Details</u></b><br>
                    {{$payment_details[0]->bank_name. ' - ' .$payment_details[0]->bank_branch ?? ''}}<br>

                    {{$payment_details[0]->account_name ?? ''}}<br>

                    Account: {{$payment_details[0]->account_number ?? ''}}<br>


                    </p>
                </div>
            </div>
            <div class="card-body">
                <div class="" style="color:black;font-weight: bold;">
                    <p>
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }} | Go to <a href="{{ route('enroll.myCourses') }}">My
                                    Scholarships</a>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                    <form action="{{ route('pre.auth.save', [$scholarship->id,$course->id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="document_id" value="14">
                        <small class="alert alert info">***Only pdf and image files accepted</small><br>
                        <input type="file" name="document" class="form-control" required accept="application/pdf">
                        <p class="mt-2"></p>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                    </p>
                </div>
            </div>
        </div>

        </div>
    </section>
@endsection
