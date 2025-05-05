@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.course.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.courses.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.course.fields.name') }}*</label>
                <select name="manager_id" required class="form-control select2">
                    <option value="">-Select Course-</option>
                    @foreach ($course_manager->groupBy('category.name') as $categoryName => $courses)
                    @php
                    // Sort courses within each category by period name
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
                <em class="invalid-feedback">
                    {{ $errors->first('name') }}
                </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.course.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                <label for="description">Course Description  </label>
                <textarea id="editor" rows="10" name="description" class="form-control " placeholder="Course Description">{{ old('description', isset($course) ? $course->description : '') }}</textarea>
                @if($errors->has('description'))
                <em class="invalid-feedback">
                    {{ $errors->first('description') }}
                </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.course.fields.description_helper') }}
                </p>
            </div>
            <!--div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
                <label for="photo">{{ trans('cruds.course.fields.photo') }}</label>
                <div class="needsclick dropzone" id="photo-dropzone">

                </div>
                @if($errors->has('photo'))
                    <em class="invalid-feedback">
                        {{ $errors->first('photo') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.course.fields.photo_helper') }}
                </p>
            </div-->

            <!--input type="hidden" name="institution_id" value="{{ auth()->user()->institution_id }}"-->

            <div class="form-group {{ $errors->has('institution_id') ? 'has-error' : '' }}">
                <label for="institution">{{ trans('cruds.course.fields.institution') }}*</label>
                <select name="institution_id" id="institution" class="form-control" required >
                    @foreach($institutions as $id => $institution)
                    <option value="{{ $id }}" 
                            {{ (isset($course) && $course->institution_id == $id) || old('institution_id', session('institution_id')) == $id ? 'selected' : '' }}>
                        {{ $institution }}
                    </option>
                    @endforeach
                </select>
                @if($errors->has('institution_id'))
                <em class="invalid-feedback">
                    {{ $errors->first('institution_id') }}
                </em>

            </div>
            @endif
            <!--div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                <label for="price">{{ trans('cruds.course.fields.price') }}</label>
                <input type="number" id="price" name="price" class="form-control" value="{{ old('price', isset($course) ? $course->price : '') }}" step="0.01">
                @if($errors->has('price'))
                    <em class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.course.fields.price_helper') }}
                </p>
            </div-->
            <div class="form-group {{ $errors->has('disciplines') ? 'has-error' : '' }}">
                <label for="disciplines">{{ trans('cruds.course.fields.disciplines') }}
                    <!--span class="btn btn-info btn-xs select-all">{{ trans('global.select_all') }}</!--span>
                    <span class="btn btn-info btn-xs deselect-all">{{ trans('global.deselect_all') }}</span></label-->
                    <select name="disciplines[]" id="disciplines" class="form-control" readonly>
                        @foreach($disciplines as $id => $disciplines)
                        <option value="{{ $id }}" {{ (in_array($id, old('disciplines', [])) || isset($course) && $course->disciplines->contains($id)) ? 'selected' : '' }}>{{ $disciplines }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('disciplines'))
                    <em class="invalid-feedback">
                        {{ $errors->first('disciplines') }}
                    </em>
                    @endif
                    <p class="helper-block">
                        {{ trans('cruds.course.fields.disciplines_helper') }}
                    </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection


