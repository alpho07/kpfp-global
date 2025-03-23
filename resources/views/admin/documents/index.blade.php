@extends('layouts.admin')
@section('content')
    <style>
        .dt-buttons {
            display: none;
        }
    </style>
    <div class="card">
        <div class="card-header">
            Document Manager
        </div>


        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Documents">
                    <thead>
                        <tr>
                            <th colspan="7" class="text-center">
                                <div class="search-form">
                                    <form method="GET" action="{{ route('admin.document.manager') }}">
                                        <div class="row">
                                            @can('all_file_filter')
                                            <div class="col-md-3">
                                                <select name="student_id" class="form-control">
                                                    <option value="">All Students</option>
                                                    @foreach (\App\Models\User::all() as $student)
                                                        <option value="{{ $student->id }}"
                                                            {{ request('student_id') == $student->id ? 'selected' : '' }}>
                                                            {{ $student->full_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @endcan
                                            <div class="col-md-3">
                                                <select name="course_id" class="form-control">
                                                    <option value="">All Courses</option>
                                                    @foreach (\App\Models\Course::all() as $course)
                                                        <option value="{{ $course->id }}"
                                                            {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                                            {{ $course->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="document_id" class="form-control">
                                                    <option value="">All Documents</option>
                                                    @foreach (\App\Models\UploadsManager::all() as $document)
                                                        <option value="{{ $document->id }}"
                                                            {{ request('document_id') == $document->id ? 'selected' : '' }}>
                                                            {{ $document->file_name }}
                                                            <!-- Adjust based on your UploadsManager model -->
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @can('all_file_filter')
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
                                            @endcan
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                                <button type="submit" name="download" value="1" class="btn btn-success">Download as ZIP</button>
                                                <a href="{{ route('admin.document.manager') }}"
                                                    class="btn btn-secondary">Reset</a>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </th>
                        </tr>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.institution.fields.id') }}
                            </th>
                            <th>
                                Student Name
                            </th>
                            <th>
                                Document Name
                            </th>
                            <th>
                                Course Name
                            </th>
                            <th>
                                Institution Name
                            </th>

                            <th>
                                Action
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($documents as $key => $document)
                            <tr data-entry-id="{{ $document->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $document->id ?? '' }}
                                </td>
                                <td>
                                    {{ $document->student->full_name ?? '' }}
                                </td>
                                <td>
                                    {{ $document->document->file_name.'.v'.$document->version ?? '' }}
                                </td>
                                <td>
                                    {{ $document->course->name ?? '' }}
                                </td>
                                <td>
                                    {{ $document->institution->name ?? '' }}
                                </td>
                                <td>
                                    <a class="btn btn-xs btn-info" href="{{ @Storage::url($document->file_path) }}"
                                        target="_blank">Download</a>

                                </td>


                            </tr>
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
        $(function() {
            $('.datatable-Documents').DataTable();
        });
    </script>
@endsection
