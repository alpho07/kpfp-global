@extends('layouts.main')

@section('head')
    {{-- Include Bootstrap 5 via CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<section class="py-5" style="background: #E6E6E6; margin-top:150px;">
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0" style="color:white;">Upload Pre-Auth Form</h4>
            </div>
            <div class="card-body text-dark fw-bold">

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }} |
                        Go to <a href="{{ route('enroll.myCourses') }}" class="alert-link">My Scholarships</a>
                    </div>
                @endif

                {{-- Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p class="mb-0">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                {{-- Upload Form --}}
                <form action="{{ route('pre.auth.save', [$scholarship->id, $course->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="document" class="form-label">Upload Document (PDF only)</label>
                        <input type="file" name="document" class="form-control" id="document" required accept="application/pdf">
                        <input type="hidden" name="document_id" value="15">
                        <div class="form-text text-danger mt-1">*** Only PDF files accepted</div>
                    </div>
                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-success">Upload</button>

                        {{-- Acknowledge Button --}}
                        <a href="{{ route('enroll.myCourses') }}" class="btn btn-secondary" style="margin-left: 10px">
                            Back
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>
@endsection
