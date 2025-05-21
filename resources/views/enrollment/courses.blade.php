@extends('layouts.main')
@section('content')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<style>
    .card {
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        border: none;
    }
    .table thead th {
        background-color: #f8f9fa;
        vertical-align: middle;
        text-align: center;
    }
    .badge-success { background-color: #28a745; }
    .badge-danger { background-color: #dc3545; }
    .btn-sm {
        font-size: 0.8rem;
    }
</style>
@endpush

<div class="card" data-aos="fade-up">
    <div class="card-header bg-primary text-white text-center py-3" style="background:#4159A4;">
        <h4 class="mb-0" style="color:white;">🎓 My Scholarship Portal</h4>
    </div>

    <div class="card-body">

        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" data-aos="fade-down">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="mb-3 text-end">
            <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-plus-circle"></i> Apply Course
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Pre-Auth Unsigned</th>
                        <th>Pre-Auth Signed</th>
                        <th>Institution</th>
                        <th>Course</th>
                        <th>Documents</th>
                        <th>Name</th>
                        <th>Applied On</th>
                        <th>Status</th>
                        <th>Age</th>
                        <th>County</th>
                        <th>ID</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Bonding Form</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($enrollments as $i => $enrollment)
                    <tr data-aos="fade-up" data-entry-id="{{ $enrollment->id }}">
                        <td>{{ $i + 1 }}</td>
                        <td>
                            <a href="{{ route('application.download', [$enrollment->id, $enrollment->scholarship_id]) }}"
                               class="btn btn-sm btn-outline-primary">
                                Download
                            </a>
                        </td>
                        <td>
                            @if ($enrollment->application && $enrollment->application->authorized_form == 'Not Uploaded')
                                <a href="{{ route('pre.auth.upload', [$enrollment->id, $enrollment->scholarship_id]) }}"
                                   class="btn btn-sm btn-outline-info">
                                    Upload
                                </a>
                            @else
                                <a href="{{ @Storage::url($enrollment->application->authorized_form_link->file_path) }}"
                                   class="btn btn-sm btn-outline-success mb-1">
                                    Download
                                </a><br>
                                <small class="text-muted">or</small><br>
                                <a href="{{ route('pre.auth.upload', [$enrollment->id, $enrollment->scholarship_id]) }}"
                                   class="btn btn-sm btn-outline-warning mt-1" title="Re-upload only if necessary">
                                    Re-Upload
                                </a>
                            @endif
                        </td>
                        <td>{{ $enrollment->institution->name }}</td>
                        <td>{{ $enrollment->course->course_manager->name }}</td>
                        <td>
                            <a href="{{ route('apply.scholarship', [$enrollment->id, $enrollment->scholarship_id]) }}?q=#step-2"
                               target="_blank" class="btn btn-link btn-sm">View Files</a>
                        </td>
                        <td>
                            {{ @$enrollment->application->preffered_name }}
                            {{ @$enrollment->application->surname }}
                            {{ @$enrollment->application->first_name }}
                        </td>
                        <td>{{ @$enrollment->application->created_at->format('Y-m-d') }}</td>
                        <td>
                            <span class="badge badge-{{ in_array(@$enrollment->application->status, ['Rejected', 'Query']) ? 'danger' : 'success' }}">
                                {{ @$enrollment->application->status }}
                            </span>
                            @if (in_array(@$enrollment->application->status, ['Rejected', 'Query']))
                            <a href="#" class="btn btn-link btn-sm text-danger" onclick="alert('{{ @$enrollment->application->comments }}')">Why?</a>
                            @endif
                        </td>
                        <td>{{ @$enrollment->application->age_years }}</td>
                        <td>{{ @$enrollment->application->county }}</td>
                        <td>{{ @$enrollment->application->national_id_pass }}</td>
                        <td>{{ @$enrollment->application->date_of_birth }}</td>
                        <td>{{ @$enrollment->application->gender }}</td>
                        <td>{{ @$enrollment->application->phone_no }}</td>
                        <td>
                            
                            @if ($enrollment->application->bonding_form == 'Not Sent')
                                <span class="text-muted">N/A</span>
                            @elseif($enrollment->application->bonding_form == 'Sent')
                                <a href="{{ route('bonding.form.upload', [$enrollment->id, $enrollment->scholarship_id]) }}"
                                   class="btn btn-sm btn-outline-info">Upload</a>
                            @else
                                <a href="{{ @Storage::url(@$enrollment->application->bonding_form_link->file_path) }}"
                                   class="btn btn-sm btn-outline-primary">Download</a>
                                <a href="{{route('bonding.form.upload',[@$enrollment->application->id, @$enrollment->application->scholarship_id])}}"
                                   class="btn btn-sm btn-warning mt-1">
                                   <small>Re-Upload</small>
                                </a>
                            @endif
                        </td>
                        <td>
                            @if ($enrollment->application->authorized_form !== 'Not Uploaded')
                                <span class="text-muted">-</span>
                            @else
                                <a href="{{ route('apply.scholarship', [$enrollment->id, $enrollment->scholarship_id]) }}"
                                   class="btn btn-sm btn-outline-secondary">Edit</a>
                            @endif
                        </td>
                    </tr>

                    @if(@$enrollment->institution->payment_option->status=='Yes')
                        <tr data-aos="fade-right">
                            <td colspan="17">
                                @if (is_null($enrollment->application->proof_of_payment))
                                    <div class="alert alert-danger">
                                        Hello {{ auth()->user()->first_name }}, you must upload the payment proof to complete your application.
                                        <a href="{{ route('proof.auth.load', [$enrollment->id, $enrollment->scholarship_id]) }}">Click here</a>
                                    </div>
                                @else
                                    <div class="alert alert-success">
                                        Payment Proof Uploaded |
                                        <a href="{{ route('proof.auth.load', [$enrollment->id, $enrollment->scholarship_id]) }}">Update</a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endif
                    @empty
                    <tr>
                        <td colspan="17">
                            <div class="alert alert-warning">
                                You haven't applied for any scholarships yet.
                                <a href="{{ route('home') }}">Explore Available Scholarships</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 700,
        once: true
    });
</script>
@endpush

@endsection
