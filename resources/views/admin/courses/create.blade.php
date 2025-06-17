@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.course.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.courses.store") }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Course Name --}}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.course.fields.name') }}*</label>
                <select name="manager_id" required class="form-control select2">
                    <option value="">-Select Course-</option>
                    @foreach ($course_manager->groupBy('category.name') as $categoryName => $courses)
                    @php
                    $sortedCourses = $courses->sortBy(fn($cm) => $cm->period->name ?? '');
                    @endphp
                    <optgroup label="{{ $categoryName }}">
                        @foreach ($sortedCourses as $cm)
                        <option value="{{ $cm->id }}">
                            {{ $cm->name }} - <strong>{{ $cm->period->name ?? 'No Period' }}</strong>
                    </option>
                    @endforeach
                    </optgroup>
                    @endforeach
                </select>
                @if($errors->has('name'))
                <em class="invalid-feedback">{{ $errors->first('name') }}</em>
                @endif
                <p class="helper-block">{{ trans('cruds.course.fields.name_helper') }}</p>
            </div>

            {{-- Description --}}
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">Course Description</label>
                <textarea id="editor" rows="10" name="description" class="form-control" placeholder="Course Description">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                <em class="invalid-feedback">{{ $errors->first('description') }}</em>
                @endif
                <p class="helper-block">{{ trans('cruds.course.fields.description_helper') }}</p>
            </div>

            {{-- Application Start Date --}}
            <div class="form-group {{ $errors->has('application_start_date') ? 'has-error' : '' }}">
                <label for="application_start_date">Application Start Date*</label>
                <input type="date" id="application_start_date" name="application_start_date" class="form-control"
                       value="{{ old('application_start_date') }}" required>
                @if($errors->has('application_start_date'))
                <em class="invalid-feedback">{{ $errors->first('application_start_date') }}</em>
                @endif
            </div>

            {{-- Application End Date --}}
            <div class="form-group {{ $errors->has('application_end_date') ? 'has-error' : '' }}">
                <label for="application_end_date">Application End Date*</label>
                <input type="date" id="application_end_date" name="application_end_date" class="form-control"
                       value="{{ old('application_end_date') }}" required>
                @if($errors->has('application_end_date'))
                <em class="invalid-feedback">{{ $errors->first('application_end_date') }}</em>
                @endif
            </div>

            {{-- Institution --}}
            <div class="form-group {{ $errors->has('institution_id') ? 'has-error' : '' }}">
                <label for="institution">{{ trans('cruds.course.fields.institution') }}*</label>
                <select name="institution_id" id="institution" class="form-control" required>
                    @foreach($institutions as $id => $institution)
                    <option value="{{ $id }}"
                            {{ old('institution_id', session('institution_id')) == $id ? 'selected' : '' }}>
                        {{ $institution }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('institution_id'))
                <em class="invalid-feedback">{{ $errors->first('institution_id') }}</em>
                @endif
            </div>

            {{-- Disciplines --}}
            <div class="form-group {{ $errors->has('disciplines') ? 'has-error' : '' }}">
                <label for="disciplines">{{ trans('cruds.course.fields.disciplines') }}</label>
                <select name="disciplines[]" id="disciplines" class="form-control" readonly>
                    @foreach($disciplines as $id => $discipline)
                    <option value="{{ $id }}" {{ in_array($id, old('disciplines', [])) ? 'selected' : '' }}>
                        {{ $discipline }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('disciplines'))
                <em class="invalid-feedback">{{ $errors->first('disciplines') }}</em>
                @endif
                <p class="helper-block">{{ trans('cruds.course.fields.disciplines_helper') }}</p>
            </div>

            {{-- Requirements --}}
            <div class="form-group">
                <label>Application Requirements</label>
                <div id="requirements-wrapper"></div>
                <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-requirement">+ Add Requirement</button>
            </div>

            {{-- Template for Requirement Rows --}}
            <template id="requirement-template">
                <div class="requirement-row mb-2 d-flex align-items-center">
                    <input type="text" name="requirement_text[]" class="form-control me-2" placeholder="Requirement" required />
                    <label class="me-2 mb-0">
                        <input type="checkbox" name="requirement_mandatory[]" class="mandatory-checkbox" />
                        Mandatory
                    </label>
                    <button type="button" class="btn btn-sm btn-danger remove-requirement">X</button>
                </div>
            </template>

            {{-- Submit --}}
            <div class="mt-3">
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function () {
    // Add requirement
    $('#add-requirement').click(function () {
        const template = $('#requirement-template').html();
        $('#requirements-wrapper').append(template);
    });

    // Remove requirement
    $('#requirements-wrapper').on('click', '.remove-requirement', function () {
        $(this).closest('.requirement-row').remove();
    });

    // Form validation
    $('form').on('submit', function (e) {
        const startDate = new Date($('#application_start_date').val());
        const endDate = new Date($('#application_end_date').val());

        if (endDate < startDate) {
            e.preventDefault();
            alert('Application end date cannot be earlier than start date.');
            return false;
        }

        // Combine requirement text + mandatory into JSON
        const requirements = [];
        $('.requirement-row').each(function () {
            const text = $(this).find('input[name="requirement_text[]"]').val();
            const mandatory = $(this).find('.mandatory-checkbox').is(':checked') ? 1 : 0;

            if (text.trim() !== '') {
                requirements.push({text, mandatory});
            }
        });

        // Add combined array into a hidden field
        $('<input>').attr({
            type: 'hidden',
            name: 'requirements_json',
            value: JSON.stringify(requirements)
        }).appendTo('form');
    });
});
</script>


