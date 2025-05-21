@extends('layouts.main')

@section('content')
<style>
    /* Container styling */
    .container.card {
        max-width: 600px;
        margin: 120px auto 60px auto;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        padding: 40px 50px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Page background */
    section.section_padding_1 {
        background: #f5f7fa;
        min-height: 100vh;
        padding: 60px 15px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }

    /* Back button styling */
    .btn-back {
        display: inline-block;
        margin-bottom: 30px;
        color: #3498db;
        font-weight: 600;
        font-size: 1.1rem;
        text-decoration: none;
        transition: color 0.25s ease;
    }
    .btn-back:hover {
        color: #1d6fa5;
        text-decoration: underline;
    }

    /* Title styling */
    .card-title h4 {
        font-weight: 700;
        font-size: 1.75rem;
        color: #222;
        margin-bottom: 30px;
        border-bottom: 2px solid #3498db;
        padding-bottom: 8px;
    }

    /* Success & error alert boxes */
    .alert {
        border-radius: 8px;
        padding: 15px 20px;
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

    /* Form elements */
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
        box-shadow: 0 0 10px rgba(52, 152, 219, 0.4);
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

    /* Input focus and box-sizing */
    input, textarea {
        box-sizing: border-box;
        font-size: 1rem;
        border-radius: 6px;
        outline: none;
    }

</style>

<section class="section_padding_1">
    <div class="container card">
        <a href="{{ route('enroll.myCourses') }}" class="btn-back">&larr; Back to My Scholarships</a>

        <div class="card-title">
            <h4>Upload KPFP Archived Documents</h4>
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

            <form action="{{ route('bonding.form.save', $id) }}" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                <small class="alert-info">*** Only zip archived files accepted</small><br>
                <input type="file" name="pdf_file" required accept=".zip">
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
</section>
@endsection
