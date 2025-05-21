@extends('layouts.main')

@section('content')
<style>
    /* Container wider and centered */
    .container.card {
        max-width: 900px;
        margin: 150px auto 50px auto;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        padding: 30px;
    }

    /* Blue border for form area */
    .paper-style {
        background-color: #fff;
        border: 1px solid #0397D6;
        border-radius: 6px;
        padding: 20px;
        margin-top: 15px;
    }

    /* Inputs with blue border and subtle shadow on focus */
    input[type=text],
    input[type=number],
    textarea,
    input[type=file] {
        border: 1px solid #3498db;
        outline: none;
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 1rem;
        transition: box-shadow 0.25s ease;
        width: 100%;
        box-sizing: border-box;
    }

    input:focus {
        box-shadow: 0 0 8px rgba(52, 152, 219, 0.7);
        border-color: #2980b9;
    }

    /* Checkbox style remains */
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

    /* Back button style */
    .btn-back {
        display: inline-block;
        margin-bottom: 20px;
        color: #3498db;
        background: transparent;
        border: none;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        text-decoration: none;
        padding: 0;
        transition: color 0.3s ease;
    }
    .btn-back:hover {
        color: #2980b9;
        text-decoration: underline;
    }

    /* Titles */
    .card-title h4 {
        font-weight: 700;
        color: #222;
        margin-bottom: 15px;
    }

    /* Alert styling */
    .alert-primary {
        background-color: #e3f2fd;
        border-color: #90caf9;
        color: #1565c0;
        padding: 20px;
        border-radius: 6px;
        font-size: 1rem;
        line-height: 1.5;
    }

    .alert-primary h3 {
        font-weight: 700;
        margin-bottom: 10px;
    }

    .alert-info {
        font-size: 0.9rem;
        color: #555;
        background-color: #d9edf7;
        border-color: #bce8f1;
        padding: 10px 15px;
        border-radius: 4px;
        margin-bottom: 15px;
        display: inline-block;
    }

    /* Form button */
    button.btn-primary {
        background-color: #3498db;
        border: none;
        padding: 10px 25px;
        font-size: 1.1rem;
        border-radius: 5px;
        transition: background-color 0.3s ease;
        font-weight: 600;
    }
    button.btn-primary:hover {
        background-color: #2980b9;
    }

    /* List styling inside alerts */
    ol {
        padding-left: 20px;
        margin-bottom: 15px;
    }
    ol li {
        margin-bottom: 8px;
    }

</style>

<section style="background: #E6E6E6;">

    <div class="container card">

        <a href="{{ route('enroll.myCourses') }}" class="btn-back">&larr; Back to My Scholarships</a>

        <div class="card-title">
            <h4>Upload | Application Fee Proof of Payment</h4>

            <div class="alert alert-primary">
                <h3>Instructions</h3>
                <ol>
                    <li>Using details provided below. Pay the application fee of Ksh <b>({{number_format($payment_details[0]->amount,2) ?? ''}})</b> to the account provided. Bank or MPESA</li>
                </ol>

                <div class="row">
                    <h5>MPESA Instructions:</h5>
                    <ol>
                        <li>On MPESA go to Lipa na MPESA</li>
                        <li>Select Paybill and enter Paybill No. <b>{{$payment_details[0]->mobile_paybill ?? ''}}</b></li>
                        <li>For account number enter <b>{{$payment_details[0]->mobile_paybill_no ?? ''}}</b></li>
                        <li>For amount number enter <b>{{number_format($payment_details[0]->amount,2) ?? ''}}</b></li>
                        <li>Take a scanned copy in PDF of the Successful M-PESA payment message</li>
                        <li>Upload the scanned document below</li>
                    </ol>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <h5>Bank Instructions:</h5>
                    <ol>
                        <li>Go to the bank and deposit application fee</li>
                        <li>Account Name: <b>{{$payment_details[0]->account_name ?? ''}}</b></li>
                        <li>Account Number: <b>{{$payment_details[0]->account_number ?? ''}}</b></li>
                        <li>Amount: <b>{{number_format($payment_details[0]->amount,2) ?? ''}}</b></li>
                        <li>Scan the deposit slip/reference document in PDF format</li>
                        <li>Upload the scanned document below</li>
                    </ol>
                </div>

                <b><u>MPESA Details</u></b><br>
                Paybill: {{$payment_details[0]->mobile_paybill ?? ''}}<br>
                Account: {{$payment_details[0]->mobile_paybill_no ?? ''}}<br><br>

                <b><u>BANK Details</u></b><br>
                {{$payment_details[0]->bank_name. ' - ' .$payment_details[0]->bank_branch ?? ''}}<br>
                {{$payment_details[0]->account_name ?? ''}}<br>
                Account: {{$payment_details[0]->account_number ?? ''}}<br>
            </div>
        </div>

        <div class="card-body" style="color:black; font-weight: bold;">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }} | Go to <a href="{{ route('enroll.myCourses') }}">My Scholarships</a>
            </div>
            @endif

            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form action="{{ route('pre.auth.save', [$scholarship->id, $course->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="document_id" value="14">

                <small class="alert-info">***Only PDF files accepted</small><br>

                <input type="file" name="document" class="form-control" required accept="application/pdf">

                <p class="mt-2"></p>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>

    </div>

</section>
@endsection
