@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.course.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.courses.update", [$course->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.course.fields.name') }}*</label>

                <select name="manager_id" required class="form-control">
                    <option value="">-Select Course-</option>
                    @foreach ($course_manager->groupBy('category.name') as $categoryName => $courses)
                    @php
                    $sortedCourses = $courses->sortBy(fn($cm) => $cm->period->name ?? '');
                    @endphp
                    <optgroup label="{{ $categoryName }}">
                        @foreach ($sortedCourses as $cm)
                        <option value="{{ $cm->id }}" {{$cm->id == $course->manager_id ? 'selected' : ''}}>
                            {{ $cm->name }} - <strong>{{ $cm->period->name ?? 'No Period' }}</strong>
                    </option>
                    @endforeach
                    </optgroup>
                    @endforeach
                </select>
                @if($errors->has('name'))
                <em class="invalid-feedback">
                    {{ $errors->first('name') }}
                </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.course.fields.name_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">Course Description</label>
                <textarea id="editor" name="description" class="form-control">{{ old('description', $course->description) }}</textarea>
                @if($errors->has('description'))
                <em class="invalid-feedback">{{ $errors->first('description') }}</em>
                @endif
                <p class="helper-block">{{ trans('cruds.course.fields.description_helper') }}</p>
            </div>

            <div class="form-group {{ $errors->has('application_start_date') ? 'has-error' : '' }}">
                <label for="application_start_date">Application Start Date*</label>
                <input type="date" id="application_start_date" name="application_start_date" class="form-control"
                       value="{{ old('application_start_date', $course->application_start_date ? $course->application_start_date->format('Y-m-d') : '') }}" required>
                @if($errors->has('application_start_date'))
                <em class="invalid-feedback">{{ $errors->first('application_start_date') }}</em>
                @endif
            </div>

            <div class="form-group {{ $errors->has('application_end_date') ? 'has-error' : '' }}">
                <label for="application_end_date">Application End Date*</label>
                <input type="date" id="application_end_date" name="application_end_date" class="form-control"
                       value="{{ old('application_end_date', $course->application_end_date ? $course->application_end_date->format('Y-m-d') : '') }}" required>
                @if($errors->has('application_end_date'))
                <em class="invalid-feedback">{{ $errors->first('application_end_date') }}</em>
                @endif
            </div>

            @if(auth()->user()->isInstitution())
            <input type="hidden" name="institution_id" value="{{ auth()->user()->institution_id ?? $course->institution_id }}">
            @else
            <div class="form-group {{ $errors->has('institution_id') ? 'has-error' : '' }}">
                <label for="institution">{{ trans('cruds.course.fields.institution') }}*</label>
                <select name="institution_id" id="institution" class="form-control select2" required>
                    @foreach($institutions as $id => $institution)
                    <option value="{{ $id }}" {{ (old('institution_id', $course->institution_id) == $id) ? 'selected' : '' }}>{{ $institution }}</option>
                    @endforeach
                </select>
                @if($errors->has('institution_id'))
                <em class="invalid-feedback">{{ $errors->first('institution_id') }}</em>
                @endif
            </div>
            @endif

            <div class="form-group {{ $errors->has('disciplines') ? 'has-error' : '' }}">
                <label for="disciplines">{{ trans('cruds.course.fields.disciplines') }}</label>
                <select name="disciplines[]" id="disciplines" class="form-control select2">
                    @foreach($disciplines as $id => $disciplines)
                    <option value="{{ $id }}" {{ (in_array($id, old('disciplines', [])) || $course->disciplines->contains($id)) ? 'selected' : '' }}>{{ $disciplines }}</option>
                    @endforeach
                </select>
                @if($errors->has('disciplines'))
                <em class="invalid-feedback">{{ $errors->first('disciplines') }}</em>
                @endif
                <p class="helper-block">{{ trans('cruds.course.fields.disciplines_helper') }}</p>
            </div>

            <div id="requirements-wrapper" class="form-group">
                <label>Course Requirements</label>
                <div id="requirement-list">
                    @foreach(old('requirements', $course->requirements ?? [ ['text' => '', 'mandatory' => 0] ]) as $index => $requirement)
                    <div class="requirement-group mb-3 border p-3 rounded">
                        <div class="form-group">
                            <label for="requirements[{{ $index }}][text]">Requirement Text</label>
                            <input type="text" name="requirements[{{ $index }}][text]" class="form-control"
                                   value="{{ old("requirements.$index.text", $requirement['text'] ?? '') }}">
                        </div>

                        <div class="form-group form-check">
                            <input type="hidden" name="requirements[{{ $index }}][mandatory]" value="0">
                            <input type="checkbox" name="requirements[{{ $index }}][mandatory]" value="1"
                                   class="form-check-input"
                                   {{ old("requirements.$index.mandatory", $requirement['mandatory'] ?? 0) ? 'checked' : '' }}>
                            <label class="form-check-label" for="requirements[{{ $index }}][mandatory]">
                                Mandatory
                            </label>
                        </div>
                    </div>
                    @endforeach
                    <button type="button" id="add-requirement" class="btn btn-secondary btn-sm mt-2">Add Requirement</button>
                </div>

                <div>
                    <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
document.getElementById('add-requirement').addEventListener('click', function () {
    const container = document.getElementById('requirement-list');
    const newItem = document.createElement('div');
    newItem.className = 'requirement-item mb-2 d-flex align-items-center';
    newItem.innerHTML = `
            <input type="text" name="requirements[][text]" class="form-control mr-2" placeholder="Requirement text">
            <label class="mr-2"><input type="checkbox" name="requirements[][mandatory]" value="1"> Mandatory</label>
            <button type="button" class="btn btn-sm btn-danger remove-requirement">Remove</button>
        `;
    container.appendChild(newItem);
});

document.addEventListener('click', function (e) {
    if (e.target && e.target.classList.contains('remove-requirement')) {
        e.target.closest('.requirement-item').remove();
    }
});
</script>


@endsection
