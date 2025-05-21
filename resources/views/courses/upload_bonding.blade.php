@extends('layouts.main')

@section('content')
<style>
    /* Section background & spacing */
    section.section_padding_1 {
        margin-top: 70px;
        background: #f5f7fa;
        min-height: 100vh;
        padding: 80px 15px 60px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }

    /* Container styling */
    .container.card {
        max-width: 80%;
        margin: 0 auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
        padding: 40px 50px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Title styling */
    .card-title h4 {
        font-weight: 700;
        font-size: 1.8rem;
        color: #222;
        margin-bottom: 25px;
        border-bottom: 3px solid #3498db;
        padding-bottom: 10px;
    }

    /* Instructions list */
    ol {
        margin: 20px 0 35px 20px;
        font-weight: 600;
        color: #333;
        line-height: 1.5;
        font-size: 1rem;
    }

    ol li {
        margin-bottom: 10px;
    }

    ol li b {
        color: #3498db;
    }

    /* Alerts */
    .alert {
        border-radius: 8px;
        padding: 14px 20px;
        margin-bottom: 30px;
        font-weight: 600;
        font-size: 1rem;
        line-height: 1.3;
    }
    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }
    .alert-danger {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }
    .alert-info {
        background-color: #e9f7fe;
        border: 1px solid #b6e0fe;
        color: #3178c6;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 15px;
        border-radius: 6px;
    }

    /* Form inputs */
    input[type="file"] {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #3498db;
        border-radius: 8px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        font-size: 1rem;
        cursor: pointer;
    }
    input[type="file"]:focus {
        border-color: #1d6fa5;
        box-shadow: 0 0 12px rgba(52, 152, 219, 0.45);
        outline: none;
    }

    /* Button styling */
    button.btn-primary {
        background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
        border: none;
        color: #fff;
        padding: 14px 30px;
        font-size: 1.1rem;
        font-weight: 700;
        border-radius: 8px;
        cursor: pointer;
        transition: background 0.3s ease, box-shadow 0.25s ease;
        box-shadow: 0 5px 15px rgba(41, 128, 185, 0.3);
        margin-top: 20px;
        width: 100%;
    }
    button.btn-primary:hover {
        background: linear-gradient(135deg, #2980b9 0%, #2471a3 100%);
        box-shadow: 0 8px 20px rgba(41, 128, 185, 0.5);
    }

    /* Blue outline border to all text inputs & textarea */
    input[type=text],
    input[type=number],
    textarea {
        border: 1px solid #3498db;
        outline: none;
        padding: 8px;
        border-radius: 6px;
        box-sizing: border-box;
        font-size: 1rem;
    }

    input:focus {
        box-shadow: 0 0 8px rgba(52, 152, 219, 0.7);
    }

    /* Checkbox styles */
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

    /* Hide .sw-btn */
    .sw-btn {
        display: none !important;
    }

</style>

<section class="section_padding_1">

    <div class="container card">
        <div class="card-title">
            <a href="{{route('enroll.myCourses')}}"><b>&#171 Back to My Scholarships</b></a>
            <h4>KPFP: Upload Filled Release and Bonding Form Documents</h4>
        </div>

        <div class="card-body" style="color:#222; font-weight: 600;">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }} | Go to <a href="{{ route('enroll.myCourses') }}" style="color:#155724; text-decoration: underline;">My Scholarships</a>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <ol>
                <li>Scan your duly filled and stamped <b>Release form</b> to PDF.</li>
                <li>Scan your duly filled and stamped <b>Bonding form</b> to PDF.</li>
                <li>Combine the two scanned documents as one document in PDF format.</li>
                <li>If combining is problematic, archive them together in one ZIP file.</li>
                <li>Upload the document or ZIP in the field below.</li>
                <li>On success, please wait for the institution to get back to you.</li>
            </ol>

            <form action="{{ route('pre.auth.save', [$scholarship->id, $course->id]) }}" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <input type="hidden" name="document_id" value="17" />
                <small class="alert-info">*** Only PDF / ZIP files accepted</small><br>
                <input type="file" name="document" required accept=".pdf,.zip" />
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>

        </div>
    </div>

</section>
@endsection
