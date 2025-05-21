@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Course
    </div>

    <div class="card-body">
        <form action="{{ route('admin.course-manager.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Course Name --}}
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">Course Name*</label>
                <input type="text" id="name" name="name" class="form-control"
                    value="{{ old('name') }}" required>
                @if($errors->has('name'))
                    <em class="invalid-feedback">{{ $errors->first('name') }}</em>
                @endif
            </div>

            {{-- Category --}}
            <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }}">
                <label for="category_id">Category*</label>
                <select name="category_id" class="form-control" required>
                    <option value="">-Select Category-</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('category_id'))
                    <em class="invalid-feedback">{{ $errors->first('category_id') }}</em>
                @endif
            </div>

            {{-- Period --}}
            <div class="form-group {{ $errors->has('month_id') ? 'has-error' : '' }}">
                <label for="month_id">Duration Running*</label>
                <select name="month_id" class="form-control" required>
                    <option value="">-Select Period-</option>
                    @foreach ($months as $month)
                        <option value="{{ $month->id }}" {{ old('month_id') == $month->id ? 'selected' : '' }}>
                            {{ $month->name }}
                        </option>
                    @endforeach
                </select>
                @if($errors->has('month_id'))
                    <em class="invalid-feedback">{{ $errors->first('month_id') }}</em>
                @endif
            </div>

         

            {{-- Submit --}}
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>

@endsection
